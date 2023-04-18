<?php
// DB_Connection
$server = "localhost";
$username = "xsdud778_spaceuser_master";
$password = "asdf4321ASDF";
$database = "xsdud778_spaceApp";
$connection = mysqli_connect($server, $username, $password, $database);
if (!$connection) {
    die(mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Infinity and Beyond</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="aurora.css">
</head>

<body>
    <aside>
        <a href="https://www.nasa.gov/content/goddard/parker-solar-probe" target="_blank">
            <img src="images/parker.png" alt="parker solar probe" width="200" id="parker">
        </a>
        <p>Learn more about Parker probe↑</p>
    </aside>
    <main>
        <div id="mountain">
            <!-- Location -->

            <div id="mapBox" w3-include-html="map.html">
                <!-- <div w3-include-html="map.html"></div> -->
            </div>


            <div id="infoBox">
                <header>
                    <h1>Enjoy the aurora from the solar wind anytime and anywhere!</h1>
                </header>

                <!-- shows real time -->
                <div>
                    <button type="button" id="showNow">Show Me Now</button>
                </div>

                <p> OR </p>
                <form action="#" method="GET">


                    <!-- 7 Days history including today -->
                    <?php
                    //Getting Solar wind data from DB
                    $query = "SELECT date, speed FROM electron_fluence_forecast ORDER BY date DESC LIMIT 7";
                    $sql = mysqli_query($connection, $query);
                    // showing <a>tags for 7 day
                    while ($data = mysqli_fetch_array($sql)) {
                        echo '<a href="index.php" id="btnspeed' . $data['speed'] . '" class="datechoice">' . $data['date'] . '</a>';
                        // Opacity calculator
                        $figure = 0;
                        if ($data['speed'] < 500) {
                            $figure = 0;
                        } elseif ($data['speed'] > 500) {
                            $figure = $data['speed'] / 1000;
                        } else {
                            $figure = 0;
                        }
                        echo "
    <script>
        " .
                            "btnspeed" . $data['speed'] . ".addEventListener('click',(e)=>{
        e.preventDefault();
        var canv = document.querySelector('canvas');
        canv.style.opacity = " . $figure . ";
        })"
                            . "
    </script>
    ";
                    }
                    ?>

                    <!-- <label for="date"></label> -->

                    <div id="rangeBox">
                        <div>
                            <label for="wind">Solor wind</label>
                            <p class="inlineBlock">
                                <input type="range" id="wind" name="wind" min="150" max="600" value="0" step="10"><span id="windVal"></span>
                            </p>

                        </div>

                        <div>
                            <label for="n2">N<sub>2</sub><sup>&#43;</sup></label>
                            <p class="inlineBlock">

                                <input type="range" id="n2" name="n2" min="0" max="78" value="0"><span id="n2Val"></span>%
                            </p>

                        </div>

                        <div>
                            <label for="ox">O</label>
                            <p class="inlineBlock">
                                <input type="range" id="ox" name="ox" min="0" max="21" value="0"><span id="oxVal"></span>%
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>
    <script src="script.js"></script>
    <script src="aurora.js"></script>
</body>

</html>
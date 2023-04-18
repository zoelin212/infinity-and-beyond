<?php
$title = "Infinity and Beyond";
// include("db_connection.php");

// JSON TO PHP ARRAY FUNCTION
function get($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    if(curl_errno($ch)){
        throw new Exception(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
// KP INDEX & Date, Time
$url = "https://services.swpc.noaa.gov/products/noaa-estimated-planetary-k-index-1-minute.json";
$result = get($url);
$data = json_decode($result, true);
$date_now = $data[1][0];
$kp_now = $data[1][1];

// Solar Wind
$url = "https://services.swpc.noaa.gov/products/summary/solar-wind-speed.json";
$result = get($url);
$data = json_decode($result, true);
$solarWind_now = $data['WindSpeed']; 

// Bz
$url = "https://services.swpc.noaa.gov/products/summary/solar-wind-mag-field.json";
$result = get($url);
$data = json_decode($result, true);
$bz_now = $data['Bz']; 

// Prep for insert DB
$insert_date = $date_now;
$insert_kp = $kp_now;
$insert_sWind = $solarWind_now;
$insert_bz = $bz_now;

$query = "SELECT date_time FROM table_name WHERE date_time = $date_now";
$sql = mysqli_query($connection, $query);
if(!$sql){
    $query ="INSERT INTO cart(dd,bb) VALUES('dd','bb')";
    mysqli_query($connection, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="600"> <!-- refreshed every 5 minutes -->
    <title><?=$title?></title>
</head>
<body>
    <h1>Aurora Now</h1>
    <p>Date and Time: <?=$date_now?></p>
    <p>KP Index: <?=$kp_now?></p>
    <p>Solar Wind: <?=$solarWind_now?> km/s</p>
    <p>Bz: <?=$bz_now?></p>
    <p>Aurora Alert</p>
</body>
</html>
<?php

$server = "localhost";
$username = "vslbau15_spaceuser_master";
$password = "asdf4321ASDF";
$database = "vslbau15_spaceApp";

$connection = mysqli_connect($server, $username, $password, $database);

if (!$connection) {
    die(mysqli_connect_error());
}

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


$query = "INSERT INTO `aurora_real_time_save`( `date_time`, `dp_index`, `solar_wind`, `bz_now`) VALUES ('$date_now','$kp_now','$solarWind_now','$bz_now')";
$sql = mysqli_query($connection, $query);

echo $query;
if ($sql) {
    echo "<p>insert successfully</p>";
} else {
    echo mysqli_error($connection);
}
?>


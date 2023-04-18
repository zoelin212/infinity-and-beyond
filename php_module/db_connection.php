<?php
    $server = "localhost";
    $username = "xsdud778_spaceuser_master";
    $password = "asdf4321ASDF";
    $database = "xsdud778_spaceApp";
    $connection = mysqli_connect($server, $user, $pwd, $database);
    
    if (!$connection) {
        die(mysqli_connect_error());
    }
    if($connection){
        echo "connected";
    }

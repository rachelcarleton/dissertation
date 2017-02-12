<?php

$db_username = 'root';
$db_password = '';
$db_name = 'booking_system';
$db_host = 'localhost';

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

if($mysqli->connect_errno) {
    echo "Error (".$mysqli->connect_erno.") ".$mysqli->connect_error;
}

?>
    
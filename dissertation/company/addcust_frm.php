<?php

// Database Connection
include "../include/session.php";
   
// Form Variables
$name = mysqli_real_escape_string($mysqli, $_POST['name']);
$address = mysqli_real_escape_string($mysqli, $_POST['address']);
$town = mysqli_real_escape_string($mysqli, $_POST['town']);
$postcode = mysqli_real_escape_string($mysqli, $_POST['postcode']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$emailaddress = mysqli_real_escape_string($mysqli, $_POST['email']);

$password = "";
$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
for($i = 0; $i < 15; $i++)
{
 $random_int = mt_rand();
 $password .= $charset[$random_int % strlen($charset)];
}
                            

// SQL Query
$query = "INSERT INTO customer (customer_name, customer_address, customer_town, customer_postcode, customer_telephone, customer_email, customer_password) VALUES('$name', '$address', '$town', '$postcode', '$telephone', '$emailaddress', '$password')";

if (mysqli_query($mysqli, $query)) {
    header("Location:index.php"); 
    die();
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
}

?>
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
$password = mysqli_real_escape_string($mysqli, $_POST['password']);

//encrypt password
$cost = ['cost' => 10];
$hash = password_hash($password, PASSWORD_BCRYPT, $cost);

// SQL Query
$query = "INSERT INTO customer (customer_name, customer_address, customer_town, customer_postcode, customer_telephone, customer_email, customer_password) VALUES('$name', '$address', '$town', '$postcode', '$telephone', '$emailaddress', '$hash')";

if (mysqli_query($mysqli, $query)) {
    header("Location:../login.php"); 
    die();
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
}

?>
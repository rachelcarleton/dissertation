<?php

// Database Connection
include "../include/session.php";
   
// Form Variables
$type = mysqli_real_escape_string($mysqli, $_POST['type']);
$name = mysqli_real_escape_string($mysqli, $_POST['company_name']);
$address = mysqli_real_escape_string($mysqli, $_POST['address']);
$town = mysqli_real_escape_string($mysqli, $_POST['town']);
$postcode = mysqli_real_escape_string($mysqli, $_POST['postcode']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$emailaddress = mysqli_real_escape_string($mysqli, $_POST['email']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);
$service = mysqli_real_escape_string($mysqli, $_POST['service']);


//encrypt password
$cost = ['cost' => 10];
$hash = password_hash($password, PASSWORD_BCRYPT, $cost);
    
// SQL Query
$query = "INSERT INTO company (business_type, company_name, address, town, postcode, telephone, email, password) VALUES('$type', '$name', '$address', '$town', '$postcode', '$telephone', '$emailaddress', '$hash')";

if (mysqli_query($mysqli, $query)) {
    header("Location:login.php"); 
    die();
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
}

$query2 = "INSERT INTO services (service_name) VALUES('$service')";
mysqli_query($mysqli, $query2);

?>
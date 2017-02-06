<?php

// Database Connection
include('connect.php');
   
// Form Variables
$type = mysqli_real_escape_string($conn, $_POST['business_type']);
$name = mysqli_real_escape_string($conn, $_POST['company_name']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$town = mysqli_real_escape_string($conn, $_POST['town']);
$postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
$telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
$emailaddress = mysqli_real_escape_string($conn, $_POST['email_address']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
    
// SQL Query
$query = "INSERT INTO company (business_type, company_name, address, postcode, telephone, email_address, password) VALUES('$type', '$name', '$address', '$postcode', '$telephone', '$emailaddress', '$password')";

if (mysqli_query($conn, $query)) {
    header("Location: login.php"); 
    die();
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>
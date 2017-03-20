<?php

include "../include/header.php";
include "../include/session.php";

$aptid = $_GET['id']; // $id is now defined

$cancelbooking = "DELETE FROM appointment WHERE appointmentID='$aptid'";

if (mysqli_query($mysqli, $cancelbooking)) {
    header("Location:index.php"); 
    die();
} else {
    echo "Error: " . $cancelbooking . "<br>" . mysqli_error($mysqli);
}

?>
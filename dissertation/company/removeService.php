<?php

include "../include/header.php";
include "../include/session.php";

$serviceid = $_GET['id']; // $id is now defined

$removeservice = "DELETE FROM services WHERE serviceID='$serviceid'";

if (mysqli_query($mysqli, $removeservice)) {
    header("Location:profile.php"); 
    die();
} else {
    echo "Error: " . $removeservice . "<br>" . mysqli_error($mysqli);
}

?>
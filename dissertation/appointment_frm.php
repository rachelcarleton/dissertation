<?php

// Database Connection
include('connect.php');

// Form Variables
$date = $_POST['date'];
$time = $_POST['time'];

// SQL Query
$sql = "INSERT INTO appointment (appointment_date, appointment_time) VALUES ('$date', '$time')";

if (mysqli_query($db, $sql)) {
    echo "New appointment has been created successfully" . "<br /> - Appointment at " . $time . " on " . $date; 
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}

mysqli_close($db);

?>
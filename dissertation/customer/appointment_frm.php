<?php

// Database Connection
include('../include/session.php');
session_start();
$id = $_SESSION['id'];

// Form Variables
$date = $_POST['date'];
$time = $_POST['time'];

$findbooking = "select * from appointment where appointment_date='$date' and appointment_time='$time'";
if ($result=mysqli_query($mysqli,$findbooking))
{
// Return the number of rows in result set
    $rowcount=mysqli_num_rows($result);
    if ($rowcount > 0) { 
       echo '<script type="text/javascript">
       alert("Sorry, there is no appointment available.");
       window.location.href = "dashboard.php";
       </script>';
       exit; 
    } else {
        
        $sql = "INSERT INTO appointment (appointment_date, appointment_time, customerID) VALUES ('$date', '$time', '$id')";

        if (mysqli_query($mysqli, $sql)) {
            echo "New appointment has been created successfully" . "<br /> - Appointment at " . $time . " on " . $date; 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
        
        $appointmentid = mysqli_insert_id($mysqli);
        
        $findapt = $mysqli->query("select * from appointment where appointmentID='$appointmentid'");
        $row = $findapt->fetch_assoc();

        $aptid = $row['appointmentID'];
        
        $sql2 = "INSERT INTO customer_appointment (customerID, appointmentID) VALUES ('$id', '$aptid' )";
        mysqli_query($mysqli, $sql2);
        
    }
// Free result set
    mysqli_free_result($result);
}

mysqli_close($mysqli);

?>
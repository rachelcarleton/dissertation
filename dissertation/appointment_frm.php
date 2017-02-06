<?php

// Database Connection
include('session.php');

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
       window.location.href = "appointment.php";
       </script>';
       exit; 
    } else {
        
        $sql = "INSERT INTO appointment (appointment_date, appointment_time) VALUES ('$date', '$time')";

        if (mysqli_query($mysqli, $sql)) {
            echo "New appointment has been created successfully" . "<br /> - Appointment at " . $time . " on " . $date; 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
        
    }
// Free result set
    mysqli_free_result($result);
}

mysqli_close($mysqli);

?>
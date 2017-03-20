<?php

// Database Connection
include('../include/session.php');
session_start();
$id = $_SESSION['id'];

// Form Variables
$date = $_POST['date'];
$time = $_POST['time'];
$service = $_POST['service'];

$findbooking = "select * from appointment where appointment_date='$date' and appointment_time='$time'";
if ($result=mysqli_query($mysqli,$findbooking))
{
// Return the number of rows in result set
    $rowcount=mysqli_num_rows($result);
    if ($rowcount > 0) { 
       echo '<script type="text/javascript">
       alert("Sorry, not appointment available.");
       window.location.href = "index.php";
       </script>';
       exit; 
    } else {
        
        $sql = "INSERT INTO appointment (appointment_date, appointment_time, serviceID, customerID) VALUES ('$date', '$time', '$service', '$id')";

        if (mysqli_query($mysqli, $sql)) {
           echo '<script>window.location.href = "index.php?success";</script>'; 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
        
    }
// Free result set
    mysqli_free_result($result);
}

mysqli_close($mysqli);

?>
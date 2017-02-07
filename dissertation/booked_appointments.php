<?php
    include "include/header.php";
    include "session.php";
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:index.php');
    }
?>
<body>
        
        <div class="row">
            <div class="container">
                
                <?php
                
                $allbookings = "select * from appointment";
                $result = $mysqli->query($allbookings);
// Return the number of rows in result set
    $rowcount=mysqli_num_rows($result);
    if ($rowcount > 0) { 
        
        
        
        while($row = $result->fetch_assoc()) {
            echo $row["appointment_date"] . " at " . $row["appointment_time"] . "<br />";
        }
       
        
        
        
    } else {
        
        echo '<script type="text/javascript">
       alert("Sorry, there are no booked appointments.");
       window.location.href = "booked_appointments.php";
       </script>';
       exit;
        
    }
// Free result set
    mysqli_free_result($result);

mysqli_close($mysqli);
                
                //form variable
                //    $date = $_POST['date'];


//            $allbookings = "select * from appointment";
//                if($result=mysqli_query($mysqli,$albookings))
//                {
//                if(!$allbookings){
//                    die("Invalid query: " .mysqli_error());
//                }
//            if ($allresult=mysqli_query($mysqli,$allbookings))
//            {
//            // Return the number of rows in result set
//                $rowcount=mysqli_num_rows($allresult);
//                if ($rowcount > 0) { 
//                   echo "<table>";
//                   while ($row_users = mysql_fetch_array($allresult)) {
//                    //output a row here
//                    echo "<tr><td>".($row_users['date'])."</td></tr>";
//                    }
//                    echo "</table>"; 
//                } else {
//                    echo "No bookings";
//
//                }
//            // Free result set
//                mysqli_free_result($allresult);
//            }

                //query to get all bookings on the same day 
            //    $bookingfordate="select * from appointment where appointment_date ='$date'";
            //    $dateresult=$mysql_query($mysqli, $datebooking);
            //
            //    //check to see if there is any bookings 
            //    if(mysql_num_rows($dateresult) >0){
            //        while($rows=mysql_fetch_assoc($dateresult)){
            //            echo($row);
            //        }
            //     } else{
            //            echo "No bookings";
            //     }
            ?>
            
            </div>
    </div>
</body>
</html>



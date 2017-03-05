<?php
    include ("../include/header.php");
    include ("../include/session.php");
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:/dissertation/company/index.php');
    }
?>
<body>
        
    <div class="row">
         <div class="container">
                
            <?php
                
             //Variables
            $date = $_GET['date'];
                
            $allbookings = "select * from appointment where appointment_date = '$date'";
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
               window.location.href = "appointment.php";
               </script>';
               exit;

            }
            // Free result set
            mysqli_free_result($result);

            mysqli_close($mysqli);

            ?>
            
        </div>
    </div>
    
</body>
</html>



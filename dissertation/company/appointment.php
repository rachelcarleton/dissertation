<?php
    include "../include/header.php";
    include "../include/session.php";
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:/dissertation/company/index.php');
    }
?>

    <body id="appointmentPage">
        
        <div id="bookAppointment">
            <div class="container">
                
                <?php 

                include "../include/session.php";
                if(isset($_POST['date']) && isset($_POST['time'])) {

                    // Form Variables
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $customer = $_POST['customer'];

                    $findbooking = "select * from appointment where appointment_date='$date' and appointment_time='$time'";
                    
                    if ($findresult=mysqli_query($mysqli,$findbooking))
                    {
                    // Return the number of rows in result set
                        $bookingcount=mysqli_num_rows($findresult);
                        if ($bookingcount > 0) { 
                           echo '<script type="text/javascript">
                           alert("Sorry, there is no appointment available.");
                           window.location.href = "appointment.php";
                           </script>';
                           exit; 
                        } else {
                            
                        $sql = "INSERT INTO appointment (appointment_date, appointment_time,customerID) VALUES ('$date', '$time','$customer')";

                        if (mysqli_query($mysqli, $sql)) {                           
                           echo '<script type="text/javascript">
                           alert("Appointment Booked.");
                           window.location.href = "appointment.php";
                           </script>';  
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                        }

                        }
                    // Free result set
                        mysqli_free_result($findresult);
                    }

                    mysqli_close($mysqli);
                    
                    
                }
                    
                ?>
                
                <div class="modal fade" id="bookedModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Booking Successful!</h4>
                            </div>
                            <div class="modal-body">
                                <p>New Appointment Booked</p>
                                <p><strong>Date: <?php echo '$date'; ?> </strong></p>
                                <p><strong>Time: <?php echo '$time'; ?> </strong></p>
                            </div>    
                        </div>
                    </div>
                </div>

                <h1>Book an Appointment</h1>

                <form method="post" id="apt-booking">
                    <select id="customer" name="customer" onchange="ifnewCheck(this);">
                        
                        <option selected disabled>Select a Customer</option>
                    
                    <?php
                
                    $findcustomer = "select * from customer";
                    $custResult = $mysqli->query($findcustomer);
                    // Return the number of rows in result set
                    $rowcount=mysqli_num_rows($custResult);

                    $rowcount=mysqli_num_rows($custResult);
                    if ($rowcount > 0) {          
                        while($row = $custResult->fetch_assoc()) {
                            echo "<option value=" . "'" . $row["customerID"] . "'>" . $row["customer_name"] . "</option>";           
                        }
                    }else {
                        echo "<option value='new'>Add New Customer</option>";
                    exit; 

                    }

                    ?>
                        <option value="new">Add New Customer</option>
                        
                    </select>
                    
                    <div id="ifNew" style="display: none;">
                        <p>Add a new customer <a href="addcustomer.php">here</a></p>
                    </div>                 
                    
                    <script>
                        function ifnewCheck(that) {
                            if (that.value == "new") {
                                document.getElementById("ifNew").style.display = "block";
                            } else {
                                document.getElementById("ifNew").style.display = "none";
                            }
                        }
                    </script>
                    <input type="date" name="date" placeholder="Appointment Date">
                    <select id="time" name="time">
                        <option selected disabled>Choose a Time</option>
                        <option value="0900">09:00</option>
                        <option value="0930">09:30</option>
                        <option value="1000">10:00</option>
                        <option value="1030">10:30</option>
                        <option value="1100">11:30</option>
                        <option value="1200">12:00</option>
                    </select>
                    <input type="submit" value="Book">
                </form>

            </div>
        </div>

        <div id="allAppointments">
            <div class="container">
                
                <?php
               
                $allbookings = "select * from appointment";
                $result = $mysqli->query($allbookings);
                // Return the number of rows in result set
                $rowcount=mysqli_num_rows($result);
                
                ?>

                <h1><?php echo $rowcount; ?> Appointments Booked</h1>

                <button id="viewBookings">View Bookings</button> 
                
                <div class="bookings" style="display:none;">

                    <?php
                
                    $rowcount=mysqli_num_rows($result);
                    if ($rowcount > 0) {          
                        while($row = $result->fetch_assoc()) {
                            echo "<h1>" . $row["appointment_date"] . " at " . $row["appointment_time"] . "</h1>";           
                        }
                        echo '<button class="hideBookings">Hide Bookings</button>';
                    }else {
                    echo '<h1>Sorry, there are 0 appointments booked';
                    exit; 

                    }

                    ?>
                
                </div>
                

            </div>
        </div>
        
        <div id="checkAppointments">
            <div class="container">
            
                <h1>Check for Appointments on certain dates</h1>

                <form action="booked_appointments_by_date.php" method="get" id="day-bookings">
                    <input type="date" name="date" placeholder="Appointment Date">
                    <input type="submit" value="Search">
                </form>
                
            </div>
        </div>
        
        <footer>
            <div class="container">
            
                <a href="../include/logout_company.php" style="font-size:18px">Logout?</a>
                
            </div>
        </footer>
        
<?php include "../include/footer.php"; ?>
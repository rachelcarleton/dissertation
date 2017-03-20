<?php
    include "../include/header.php";
    include "../include/session.php";
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:/dissertation/login.php');
    }
    $id = $_SESSION['id'];
?>

    <body id="appointmentPage">
        
        <header>
            <div class="container">
                
                <?php 
                $comdetails = $mysqli->query("select * from company where companyID = '$id'");
                $row = $comdetails->fetch_assoc();

                $comname = $row['company_name'];
                
                ?>
                
                <h1>Hello, <?php echo $comname; ?></h1>
                <p><a href="profile.php">Edit Profile</a></p>
                
            </div>           
        </header>
        
        <div id="bookAppointment">
            <div class="container">
                
                <?php 

                include "../include/session.php";
                if(isset($_POST['date']) && isset($_POST['time'])) {

                    // Form Variables
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $customer = $_POST['customer'];
                    $service = $_POST['service'];

                    $findbooking = "select * from appointment where appointment_date='$date' and appointment_time='$time'";
                    
                    if ($findresult=mysqli_query($mysqli,$findbooking))
                    {
                    // Return the number of rows in result set
                        $bookingcount=mysqli_num_rows($findresult);
                        if ($bookingcount > 0) { 
                           echo '<script type="text/javascript">
                           alert("Sorry, there is no appointment available.");
                           window.location.href = "index.php";
                           </script>';
                           exit; 
                        } else {
                            
                        $sql = "INSERT INTO appointment (appointment_date, appointment_time, serviceID, customerID) VALUES ('$date', '$time', '$service', '$customer')";

                        if (mysqli_query($mysqli, $sql)) {                           
                           echo '<script type="text/javascript">
                           alert("Appointment Booked.");
                           window.location.href = "index.php";
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
                                <p><strong>Date: <?php echo $date; ?> </strong></p>
                                <p><strong>Time: <?php echo $times; ?> </strong></p>
                            </div>    
                        </div>
                    </div>
                </div>

                <h1>Book an Appointment</h1>

                <form method="post" id="apt-booking">
                    <select id="customer" name="customer" onchange="ifnewCustomerCheck(this);">
                        
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
                    
                    <script>
                         function ifnewCustomerCheck(that) {
                            if (that.value == "new") {
                                window.location = "addcustomer.php";
                            }
                        }
                    </script>
                    
                    <select id="service" name="service" onchange="ifnewServiceCheck(this);">
                        
                        <option selected disabled>Select a Service</option>
                    
                    <?php
                
                    $findservice = "select * from services";
                    $servResult = $mysqli->query($findservice);
                    // Return the number of rows in result set
                    $rowcount=mysqli_num_rows($servResult);
                    if ($rowcount > 0) {          
                        while($row = $servResult->fetch_assoc()) {
                            echo "<option value=" . "'" . $row["serviceID"] . "'>" . $row["service_name"] . "</option>";           
                        }
                    }else {
                        echo "<option value='new'>Add New Service</option>";
                    exit; 

                    }

                    ?>
                        <option value="new">Add New Service</option>
                        
                    </select>               
                    
                    <script>
                         function ifnewServiceCheck(that) {
                            if (that.value == "new") {
                                window.location = "profile.php";
                            }
                        }
                    </script>
                    
                    <input type="date" name="date" placeholder="Appointment Date">
                    
                    <?php
                    
                    
                    
                    ?>
                    
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
               
                $allbookings = "SELECT * FROM appointment WHERE appointment_date >= CURDATE();";
                // Return the number of rows in result set
                $bookingresult = $mysqli->query($allbookings);
                $rowcount=mysqli_num_rows($bookingresult);
                
                ?>

                <h1><?php echo $rowcount; ?> Appointments Booked</h1>

                <button id="viewBookings">View Bookings</button> 
                
                <div class="bookings" style="display:none;">

                    <?php
                    
                    $custid = $row['customerID'];
                    $aptdate = $row['appointment_date'];
                    $apttime = $row['appointment_time'];
                    $today = date("Y/m/d"); 
                        
                    $getcustomer = $mysqli->query("SELECT customer_name FROM customer WHERE customerID = '$custid'");
                    $custrow = $getcustomer->fetch_assoc();

                    $customername = $custrow['customer_name']; 
                    
                    $date = new DateTime($row['appointment_date']);
                    $now = new DateTime();
                
                    if ($rowcount >= 0) {          
                        while($row = $bookingresult->fetch_assoc()) {     
                            $custid = $row['customerID'];
                            $aptdate = $row['appointment_date'];
                            $apttime = $row['appointment_time'];

                            $getcustomer = $mysqli->query("SELECT customer_name FROM customer WHERE customerID = '$custid'");
                            $custrow = $getcustomer->fetch_assoc();

                            $customername = $custrow['customer_name'];
                            
                           
                             echo "<h1>" . $custrow['customer_name'] . " - " . $row['appointment_date'] . " at " . $row['appointment_time'] . "</h1>"; 
                            echo "<a data-toggle='modal' data-target='#cancelModal'>Cancel</a>";   
                                                    
                            
                            ?>
                    
                    
                            <!-- Modal -->
                            <div id="cancelModal" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Are you sure></h4>
                                  </div>
                                  <div class="modal-body">
                                    <h1>Are you sure you want to cancel this appointment?</h1>
                                  </div>
                                  <div class="modal-footer">
                                    <?php  echo "<a href='cancel.php?id=" . $row['appointmentID'] . "'>Yes</a>";  ?>
                                    <a data-dismiss="modal">No</a>
                                  </div>
                                </div>

                              </div>
                            </div>
                    
                            <?php
                            echo "<hr>";    
                            
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
            
                <h1>Check for Appointments</h1>
                
                <h2>By Date</h2>

                <form action="booked_appointments_by_date.php" method="get" id="day-bookings">
                    <input type="date" name="date" placeholder="Appointment Date">
                    <input type="submit" value="Search">
                </form>
                
                <h2>By Customer</h2>

                <form action="booked_appointments_by_customer.php" method="get" id="day-bookings">
                    
                    <select name="customername">
                    
                        <option selected disabled>Select a Customer</option>
                        
                        <?php

                        $findcustomers = "SELECT * FROM customer";

                        $customerResult = $mysqli->query($findcustomers);
                        $customerCount = mysqli_num_rows($customerResult);    

                        while($customerRow = $customerResult->fetch_assoc()) {
                            echo "<option value=" . "'" . $customerRow["customerID"] . "'>" . $customerRow["customer_name"] . "</option>";           
                        }

                        ?>
                    
                    </select>
                    
                    <input type="submit" value="Search">
                </form>
                
                
            </div>
        </div>
        
        <div id="addCustomer">
            <div class="container">
            
                <a href="addcustomer.php">Add Customer</a>
            
            </div>
        </div>
        
        <footer>
            <div class="container">
            
                <a href="../include/logout_company.php" style="font-size:18px">Logout?</a>
                
            </div>
        </footer>
        
<?php include "../include/footer.php"; ?>
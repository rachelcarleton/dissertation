<?php
    include "../include/header.php";
    include "../include/session.php";
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:/dissertation/login.php');
    }
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];

?>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>

    <body class="customerPage">
        
        <?php
        
        if(isset($_GET['success'])) {
            echo "<div class='alert'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "Appointment Booked";
            echo "</div>";
        }
        
        ?>
        
        <header>
            <div class="container">
                
                <?php 
                $custdetails = $mysqli->query("select * from customer where customerID = '$id'");
                $row = $custdetails->fetch_assoc();

                $custname = $row['customer_name'];
                
                ?>
                
                <h1>Hello, <?php echo $custname; ?></h1>
                <p><a href="profile.php">Edit Profile</a></p>
                
            </div>           
        </header>
        
        <div id="bookAppointment">
            <div class="container">
        
                <h1>Book an Appointment</h1>

                <form action="appointment_frm.php" method="post" id="apt-booking">
                    
                    <select id="service" name="service">
                        <option selected disabled>Select a Service</option>
                        
                        <?php
                        
                        $findservice = "SELECT * FROM services";
                        $serviceResult = $mysqli->query($findservice);
                        $serviceCount = mysqli_num_rows($serviceResult);
                        
                        
                        while($serviceRow = $serviceResult->fetch_assoc()) {
                            echo "<option value=" . "'" . $serviceRow["serviceID"] . "'>" . $serviceRow["service_name"] . "</option>";           
                        }

                        ?>
                        
                    </select>
                    
                    <input type="date" name="date" placeholder="Appointment Date">
                    <select id="time" name="time">               
                        <option disabled selected>Choose a Time</option>
                        <option value="0900">09:00</option>
                        <option value="1000">10:00</option>
                        <option value="1100">11:00</option>
                        <option value="1200">12:00</option>
                        <option value="1300">13:00</option>
                        <option value="1400">14:00</option>
                        <option value="1500">15:00</option>
                        <option value="1600">16:00</option>
                    </select>
                    <input type="submit" value="Book">
                </form>
            
            </div>
        </div>
        
        <div id="allAppointments">
            <div class="container">
            
                <?php
               
                $allbookings = "select * from appointment where customerID = '$id' ";
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
                            
                            $appointmentid = $row['appointmentID'];
                            
                            echo "<h1>" . $row['appointment_date'] . " at " . $row['appointment_time'] . "</h1>";
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
                            echo "<hr />"; 
                            
                        } mysqli_close($mysqli);
                        echo '<button class="hideBookings">Hide Bookings</button>';
                    } else {
                    echo '<h1>Sorry, there are 0 appointments booked';
                    }

                    ?>
                    
                </div>
                
            </div>
        </div>
        
        
        <footer>
            <div class="container">
            
                <a href="../include/logout_customer.php" style="font-size:18px">Logout?</a>
                
            </div>
        </footer>
        
<?php include "../include/footer.php"; ?>
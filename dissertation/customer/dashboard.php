<?php
    include "../include/header.php";
    include "../include/session.php";
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:/dissertation/customer/index.php');
    }
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];

?>

    <body class="customerPage">
        
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
                    <input type="date" name="date" placeholder="Appointment Date">
                    <select id="time" name="time">
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
               
                $allbookings = "select * from appointment where customerID = $id ";
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
        
        
        <footer>
            <div class="container">
            
                <a href="../include/logout_customer.php" style="font-size:18px">Logout?</a>
                
            </div>
        </footer>
        
<?php include "../include/footer.php"; ?>

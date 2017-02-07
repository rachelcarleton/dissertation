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
                
                <h1>Hello <?php echo $_SESSION['name']; ?> </h1>
        
                <a href="logout.php" style="font-size:18px">Logout?</a>

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
                
                <h1>Check for Appointments</h1>
                
                <a href="booked_appointments.php">Check All Appointments</a>             
                
<!--
                <form action="booked_appointments.php" method ="post" id="booked_app">
                    <input type="date" name="date" placeholder="Check a day">
                    <input type="sumbit" value="Check for appointments">
                </form>
-->
            
            </div>
        </div>
        

        
        
    </body>
</html>
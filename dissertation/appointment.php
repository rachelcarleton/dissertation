<?php
include "session.php";
session_start();
if(!isset($_SESSION['email'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
    
    <head>
        
        <title>Dissertation - Rachel Carleton</title>
    
    </head>
    
    <body>

        <h1>Hello <?php echo $_SESSION['email']; ?> </h1>
        
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
        
    </body>
</html>
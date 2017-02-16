<?php include('../include/header.php'); ?>

<body>

<div class="row">
    <div class="container">
        
        
        <h3>Customer Login Form</h3>
    
        <?php 

            include "../include/session.php";
            if(isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $hashQuery = $mysqli->query("SELECT * from customer where customer_email='$email'");
                $hashRow= $hashQuery->fetch_assoc();
                $hashPass = $hashRow['customer_password'];

                $findcustomer = $mysqli->query("select * from customer where customer_email='$email' and customer_password='$hashPass'");
                $row = $findcustomer->fetch_assoc();

                $emailaddress = $row['customer_email'];
                $name = $row['customer_name'];
                $pass = $row['customer_password'];
                $id = $row['customerID'];

                if($email==$emailaddress && $hashPass==$pass) {

                    session_start();
                    $_SESSION['email']=$emailaddress;
                    $_SESSION['password']=$pass;
                    $_SESSION['name']=$name;
                    $_SESSION['id']=$id;

                    ?>

                    <script>window.location.href='appointment.php';</script>
                    <?php
                }
            }
        ?>

        <form method="post">

            <label>Email Address:</label><br>
            <input id="email" type="text" name="email" placeholder="email address" /><br><br>

            <label>Password:</label><br>
            <input id="password" type="password" name="password" placeholder="password" />  <br><br>

            <button type="submit" name="login">Login</button> 

        </form>
        
        <p>Don't have an account?</p>
        <a href="signup.php">Sign Up Now</a>

    
    </div>
</div>

</body>
</html>
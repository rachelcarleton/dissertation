<?php include('../include/header.php'); ?>

<body id="loginPage">

<div class="container">
    <div class="card card-container">
        
        
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

                    <script>window.location.href='dashboard.php';</script>
                    <?php
                }
            }
        ?>

        <form class="form-signin" method="post"> 
            
            <span id="reauth-email" class="reauth-email"></span>
            <input id="email" type="text" name="email" placeholder="email address" />
            <input id="password" type="password" name="password" placeholder="password" />
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login">Sign in</button>

        </form>
        
        <p>Don't have an account?</p>
        <a href="signup.php">Sign Up Now</a>

    
    </div>
</div>

</body>
</html>
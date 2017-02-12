<?php include('../include/header.php'); ?>

<body>

<div class="row">
    <div class="container">
        
        
        <h3>Company Login Form</h3>
    
        <?php 

            include "../include/session.php";
            if(isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $hashQuery = $mysqli->query("SELECT * from company where email='$email'");
                $hashRow= $hashQuery->fetch_assoc();
                $hashPass = $hashRow['password'];

                $sql = $mysqli->query("select * from company where email='$email' and password='$hashPass'");
                $row = $sql->fetch_assoc();

                $emailaddress = $row['email'];
                $name = $row['company_name'];
                $pass = $row['password'];

                //check email and password match db entry
                if($email==$emailaddress && $pass==$hashPass) {

                    session_start();
                    $_SESSION['email']=$emailaddress;
                    $_SESSION['password']=$pass;
                    $_SESSION['name']=$name;

                    ?>

                    <script>window.location.href='appointment.php';</script>
                    <?php
                }else {
                    echo "Wrong username or password";
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
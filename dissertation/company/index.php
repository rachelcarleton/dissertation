<?php include('../include/header.php'); ?>

<body id="loginPage">
  
    <div class="container">
        <div class="card card-container">
            
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
            
            <h1>Login</h1>
            
            
            <form class="form-signin" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input id="email" type="text" name="email" placeholder="email address" />
                <input id="password" type="password" name="password" placeholder="password" />
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login">Sign in</button>
            </form><!-- /form -->
            
        </div><!-- /card-container -->
    </div><!-- /container -->


</body>
</html>
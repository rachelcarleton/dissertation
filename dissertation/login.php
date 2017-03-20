<?php
    include "include/header.php";
?>

<body id="loginPage">
    <div class="container">
        <div class="card card-container">
            
                <?php 

                include "include/session.php";
                if(isset($_POST['email']) && isset($_POST['password'])) {
                    
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $usertype = $_POST['usertype'];
                    
                    if($usertype == 'customer') {
                        
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

                        <script>window.location.href='customer/index.php';</script>
                        
                        <?php 
                        }
                    }
                        
                  if($usertype == 'company') {

                     $hashQuery = $mysqli->query("SELECT * from company where email='$email'");
                    $hashRow= $hashQuery->fetch_assoc();
                    $hashPass = $hashRow['password'];

                    $findcompany = $mysqli->query("select * from company where email='$email' and password='$hashPass'");
                    $row = $findcompany->fetch_assoc();

                    $emailaddress = $row['email'];
                    $name = $row['company_name'];
                    $pass = $row['password'];
                    $id = $row['companyID'];


                    if($email==$emailaddress && $hashPass==$pass) {

                        session_start();
                        $_SESSION['email']=$emailaddress;
                        $_SESSION['password']=$pass;
                        $_SESSION['name']=$name;
                        $_SESSION['id']=$id;
                        ?>

                    <script>window.location.href='company/index.php';</script>
                        <?php
                    }
                        
                        
                    }

                   
                }
            ?>
        
            <h3>Login</h3>
            
            <form class="form-signin" method="post"> 
                <input type="radio" name="usertype" value="company"> Company<br>
                <input type="radio" name="usertype" value="customer"> Customer<br>
                <input id="email" type="text" name="email" placeholder="email address" />
                <input id="password" type="password" name="password" placeholder="password" />
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login">Sign in</button>

        </form>
        
        <p>Are you a customer and don't have an account?</p>
        <a href="customer/signup.php">Sign Up Now</a>
            
        </div>      
    </div>
</body>
</html>
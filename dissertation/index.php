<?php include('include/header.php'); ?>

<body>

<div class="row">
    <div class="container">
        
        
        <h3>Login Form</h3>
    
        <?php 

            include "session.php";
            if(isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $sql = $mysqli->query("select * from company where email='$email' and password='$password'");
                $row = $sql->fetch_assoc();

                $emailaddress = $row['email'];
                $name = $row['company_name'];
                $pass = $row['password'];

                if($email==$emailaddress && $password==$pass) {

                    session_start();
                    $_SESSION['email']=$emailaddress;
                    $_SESSION['password']=$pass;
                    $_SESSION['name']=$name;

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

    
    </div>
</div>

</body>
</html
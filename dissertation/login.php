<?php 

session_start();

include('session.php');

if(isset($_POST['login'])) {
    $email = secure($_POST['email'], $db);
    $password = secure($_POST['password'], $db);
    
    $q = "select * from company where email = '$email' and password = '$password' ";
    
    if($res = $mysqli->query($q)) {
        if($res->num_rows > 0) {
            $_SESSION['email'] = $email;
            header("Location: appointment.php");
            exit;
        }
    }
} else {
    echo '<script>alert("Invalid Username or Password");</script>';
    header("Location:index.php");
    exit;
}

?>
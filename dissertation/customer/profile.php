<?php
    include "../include/header.php";
    include "../include/session.php";
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:/dissertation/login.php');
    }

    $id = $_SESSION['id'];
    $name = $_SESSION['name'];

?>

    <body>
        
        <div>
            <div class="container">
                
                <h1>Your Details</h1>
                
                <?php 
                $custdetails = $mysqli->query("select * from customer where customerID = '$id'");
                $row = $custdetails->fetch_assoc();

                $custname = $row['customer_name'];
                $address = $row['customer_address'];
                $town = $row['customer_town'];
                $postcode = $row['customer_postcode'];
                $telephone = $row['customer_telephone'];
                $emailaddress = $row['customer_email'];
                
                ?>
                
                <p><?php echo $custname; ?></p>
                <p><?php echo $address; ?></p>
                <p><?php echo $town; ?></p>
                <p><?php echo $postcode; ?></p>
                <p><?php echo $telephone; ?></p>
                <p><?php echo $emailaddress; ?></p>
                
                <a href="edit-profile.php">Edit Details</a>
                
                <h1>Change Password</h1>
                
                <?php
                
                if (isset($_POST['newpassword']) && isset($_POST['newpassword2']))
                {

                  $password1 = $_POST['newpassword'];
                  $password2 = $_POST['newpassword2'];
                    
                    
                    if ($password1 == $password2) {
                        
                        $cost = ['cost' => 10];
                        $hash = password_hash($password1, PASSWORD_BCRYPT, $cost);
                        
                        $changepass = "UPDATE customer SET customer_password = '$hash' WHERE customerID = '$id'";
                        
                         if (mysqli_query($mysqli, $changepass)) {                       
                           echo 'Password has been changed.';  
                         } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                        }

                        mysqli_close($mysqli);
                        
                        
                    } else {
                        echo "Passwords do not match. Please try again.";
                    }
                 
                }
                
                ?>
                
                <form method="post">
                    <input type="password" name="newpassword" placeholder="New Password">
                    <input type="password" name="newpassword2" placeholder="Repeat Password">
                    <button type="submit">Submit</button>
                </form>
                
                <p><a href="index.php">Back to Dashboard</a></p>
                
            </div>
        </div>

<?php include "../include/footer.php"; ?>
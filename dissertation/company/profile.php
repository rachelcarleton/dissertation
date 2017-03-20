<?php
    include "../include/header.php";
    include "../include/session.php";
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:/dissertation/login.php');
    }

    $id = $_SESSION['id'];

?>

    <body>
        
        <div>
            <div class="container">
                
                <h1>Company Details</h1>
                
                <?php 
                $compdetails = $mysqli->query("select * from company where companyID = '$id'");
                $row = $compdetails->fetch_assoc();

                $compname = $row['company_name'];
                $address = $row['address'];
                $town = $row['town'];
                $postcode = $row['postcode'];
                $telephone = $row['telephone'];
                $emailaddress = $row['email'];
                
                ?>
                
                <p><?php echo $compname; ?></p>
                <p><?php echo $address; ?></p>
                <p><?php echo $town; ?></p>
                <p><?php echo $postcode; ?></p>
                <p><?php echo $telephone; ?></p>
                <p><?php echo $emailaddress; ?></p>
                
                <a href="edit-profile.php">Edit Details</a>
                
                <h1>Company Services</h1>
                
                <?php 
                
                $getservices = $mysqli->query("SELECT * FROM services");
                $servicesRow = $getservices->fetch_assoc();
                
                echo "<p>" . $servicesRow["service_name"] . "</p>";
                
                while($servicesRow = $getservices->fetch_assoc()) {
                    $service = $servicesRow["service_name"];
                    
                    echo "<p>" . $service . "</p>";
                    echo "<a data-toggle='modal' data-target='#cancelModal'>Cancel</a>";
                    
                    ?>
                
                    <!-- Modal -->
                    <div id="cancelModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure></h4>
                          </div>
                          <div class="modal-body">
                            <h1>Are you sure you want to cancel this appointment?</h1>
                          </div>
                          <div class="modal-footer">
                            <?php  echo "<a href='removeService.php?id=" . $servicesRow['serviceID'] . "'>Yes</a>";  ?>
                            <a data-dismiss="modal">No</a>
                          </div>
                        </div>

                      </div>
                    </div>
                
                
                <?php
                }
                
                if(isset($_POST["servicename"])) {
                    $name = $_POST["servicename"];
                    
                    $addservice = "INSERT INTO services (service_name) VALUES ('$name')";
                    
                    if (mysqli_query($mysqli, $addservice)) {
                       header("Location:profile.php");
                        die();
                    } else {
                         echo "Error: " . $addservice . "<br>" . mysqli_error($mysqli);
                    }
                } 
                
                
                ?>
                
                <form method="post">
                    <input type="text" name="servicename" placeholder="Add a Service" />
                    <input type="submit" name="servicesubmit">              
                </form>
                
                <h1>Change Password</h1>
                
                <?php
                
                if (isset($_POST['newpassword']) && isset($_POST['newpassword2']))
                {

                  $password1 = $_POST['newpassword'];
                  $password2 = $_POST['newpassword2'];
                    
                    
                    if ($password1 == $password2) {
                        
                        $cost = ['cost' => 10];
                        $hash = password_hash($password1, PASSWORD_BCRYPT, $cost);
                        
                        $changepass = "UPDATE company SET password = '$hash' WHERE companyID = '$id'";
                        
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
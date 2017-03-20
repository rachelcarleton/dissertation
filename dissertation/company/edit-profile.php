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
                
                <h1>Edit Details</h1>
                
                <?php
                if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['town']) && isset($_POST['postcode']) && isset($_POST['telephone']) && isset($_POST['email']) ) {
                    
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $town = $_POST['town'];
                    $postcode = $_POST['postcode'];
                    $telephone = $_POST['telephone'];
                    $emailaddress = $_POST['email'];
                    
                    $editprofile = "UPDATE company SET company_name = '$name', address = '$address', town = '$town', postcode = '$postcode', telephone = '$telephone', email = '$emailaddress' WHERE companyID = '$id'";
                    
                    if (mysqli_query($mysqli, $editprofile)) {                       
                           echo '<script type="text/javascript">
                           alert("Details Updated.");
                           window.location.href = "index.php";
                           </script>';  
                     } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                    }
                    
                    mysqli_close($mysqli);
                    
                } ?>
                
                <form method="post">
                    
                    <?php

                    $companyinfo = $mysqli->query("select * from company where companyID = '$id'");
                    $row = $companyinfo->fetch_assoc();
                    
                    $compname = $row['company_name'];
                    $address = $row['address'];
                    $town = $row['town'];
                    $postcode = $row['postcode'];
                    $telephone = $row['telephone'];
                    $emailaddress = $row['email'];
                    
                    echo "<input name=\"name\" type=\"text\" value=\"" . $compname. "\">";
                    
                    echo "<input name=\"address\" type=\"text\" value=\"" . $address. "\">";
                    
                    echo "<input name=\"town\" type=\"text\" value=\"" . $town. "\">";
                    
                    echo "<input name=\"postcode\" type=\"text\" value=\"" . $postcode. "\">";
                    
                    echo "<input name=\"telephone\" type=\"text\" value=\"" . $telephone. "\">";
                    
                    echo "<input name=\"email\" type=\"text\" value=\"" . $emailaddress. "\">";
                    
                    ?>
                    
                    <button type="submit">Submit</button>
                </form>
                
                <a href="profile.php">Back to Profile</a>
                
            </div>
        </div>

<?php include "../include/footer.php"; ?>
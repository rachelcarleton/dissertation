<?php
    include "../include/header.php";
    include "../include/session.php";
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:/dissertation/customer/index.php');
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
                    
                    $editprofile = "UPDATE customer SET customer_name = '$name', customer_address = '$address', customer_town = '$town', customer_postcode = '$postcode', customer_telephone = '$telephone', customer_email = '$emailaddress' WHERE customerID = '$id'";
                    
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
                  <input type="text" name="name" placeholder="Enter Full Name">
                    <input type="text" name="address" placeholder="Enter Address">
                    <input type="text" name="town" placeholder="Enter Town">
                    <input type="text" name="postcode" placeholder="Enter Postcode">
                    <input type="text" name="telephone" placeholder="Enter Telephone">
                    <input type="text" name="email" placeholder="Enter Email Address">
                    <button type="submit">Submit</button>
                </form>
                
            </div>
        </div>

<?php include "../include/footer.php"; ?>
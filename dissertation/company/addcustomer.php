<?php
    include "../include/header.php";
    include "../include/session.php";
    session_start();
    if(!isset($_SESSION['email'])) {
        header('location:/dissertation/company/index.php');
    }
?>

<body id="addCustomerPage">
    
    <div id="addCustomer">
        <div class="container">
            
            <form method="post" action="addcust_frm.php" id="register">
                <input type="text" name="name" placeholder="Enter Full Name">
                <input type="text" name="address" placeholder="Enter Address">
                <input type="text" name="town" placeholder="Enter Town">
                <input type="text" name="postcode" placeholder="Enter Postcode">
                <input type="text" name="telephone" placeholder="Enter Telephone">
                <input type="text" name="email" placeholder="Enter Email Address">
                <input type="submit" value="Sign Up">
            </form>          
        
        </div>
    </div>


</body>

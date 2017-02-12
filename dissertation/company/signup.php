<?php include('../include/header.php'); ?>
<!DOCTYPE html>    
   
    <body>     
    
        <h1>Company Sign Up</h1>
        
        <form action="signup_frm.php" method="post" id="register">
            <input type="text" name="company_name" placeholder="Enter Company Name">
            <input type="text" name="address" placeholder="Enter Address">
            <input type="text" name="town" placeholder="Enter Town">
            <input type="text" name="postcode" placeholder="Enter Postcode">
            <input type="text" name="telephone" placeholder="Enter Telephone">
            <input type="text" name="email" placeholder="Enter Email Address">
            <input type="password" name="password" placeholder="Create Password">
            <input type="submit" value="Sign Up">
        </form>
        
        <p>Already have an acccount? <a href="login.php">Log In</a></p>
        
    </body>
</html>
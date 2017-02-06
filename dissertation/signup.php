

<!DOCTYPE html>
<html>
    
    <head>
        
        <title>Dissertation - Rachel Carleton</title>
    
    </head>
    
    <body>
        
    
        <h1>Booking System</h1>
        
        <p>Sign Up Now</p>
        
        <form action="signup_frm.php" method="post" id="register">
            <select id="business_type" name="business_type">
                <option selected disabled>-- Choose Business Type --</option>
                <option value="automotive">Automotive</option>
                <option value="beauty">Beauty</option>
                <option value="fitness">Health &amp; Fitness</option>
            </select>
            <input type="text" name="company_name" placeholder="Enter Company Name">
            <input type="text" name="address" placeholder="Enter Address">
            <input type="text" name="town" placeholder="Enter Town">
            <input type="text" name="postcode" placeholder="Enter Postcode">
            <input type="text" name="telephone" placeholder="Enter Telephone">
            <input type="text" name="email_address" placeholder="Enter Email Address">
            <input type="password" name="password" placeholder="Create Password">
            <input type="submit" value="Sign Up">
        </form>
        
        <p>Already have an acccount? <a href="login.php">Log In</a></p>
        
    </body>
</html>
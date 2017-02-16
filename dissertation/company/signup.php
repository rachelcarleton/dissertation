<?php include('../include/header.php'); ?>
<!DOCTYPE html>    
   
    <body> 
        
        <script>
        
            $(document).ready(function() {
                var max_fields      = 10; //maximum input boxes allowed
                var wrapper         = $(".input_fields_wrap"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div><input type="text" name="service"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                    }
                });

                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });
        
        </script>
    
        <h1>Company Sign Up</h1>
        
        <form action="signup_frm.php" method="post" id="register">
            <input type="text" name="company_name" placeholder="Enter Company Name">
            <input type="text" name="address" placeholder="Enter Address">
            <input type="text" name="town" placeholder="Enter Town">
            <input type="text" name="postcode" placeholder="Enter Postcode">
            <input type="text" name="telephone" placeholder="Enter Telephone">
            <input type="text" name="email" placeholder="Enter Email Address">
            <input type="password" name="password" placeholder="Create Password">
            
            <h2>Company Details</h2>
            
            <p>Which industry is your business in?</p>
            
            <select name="type" type="text">
                <option>Health &amp; Fitness</option>
                <option>Beauty</option>
                <option>Automotive</option>
                <option>Computers</option>
            </select>
            
            <p>What services does your business offer?</p>
            
            <div class="input_fields_wrap">
                <button class="add_field_button">Add More Fields</button>
                <div><input type="text" name="service" placeholder="Add Service"></div>
            </div>
            
            <br /><br />
            
            <input type="submit" value="Sign Up">
        </form>
        
        <p>Already have an acccount? <a href="login.php">Log In</a></p>
        
    </body>
</html>
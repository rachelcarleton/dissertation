<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Sign Up - Booking System</title>
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
    
    <header>
        <div class="container">
            
            <h1>Sign Up Now</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam elementum vitae ipsum sed ultrices.</p>
            <i class="fa fa-chevron-down faa-bounce animated" aria-hidden="true"></i>
        
        </div>
    </header> 
    
    <?php
    if(isset($_POST['submit'])){
        $to = "rachel-carleton@hotmail.co.uk";
        $from = $_POST['email']; // this is the sender's Email address

        $name = $_POST['companyname'];
        $address = $_POST['address'];
        $town = $_POST['town'];
        $postcode = $_POST['postcode'];
        $telephone = $_POST['telephone'];
        $industry = $_POST['industry'];
        $other = $_POST['otherindustry'];
        $services = $_POST['services'];

        $subject = "New Booking System Sign Up";
        $subject2 = "Thank you for signing up to BS";

        $message = "You have a new sign up. Company details as follows" . "\n\n" . $name . "\n\n" . $address . "\n\n" . $town . "\n\n" . $postcode . "\n\n" . $telephone . "\n\n" . $industry . "\n\n" . $other . "\n\n" . $services;
        $message2 = "Hello!" . "\n\n" . "Thank you for signing up to BS. We will be in touch shortly when your system has been setup.";

        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2);
        echo "<div class='alert'>";
        echo "<span class='closebtn'>&times;</span>";
        echo "Thank you for your message. We will be in touch soon";
        echo "</div>";
        }
    ?>
    
    <div id="start" class="row">
        <div class="container">
            
            <h2>Please provide some details about your business. This way we can accurately set up your system.</h2>
            
            <form action="" method="post">
            
                <input type="text" name="companyname" placeholder="Company Name">
                <input type="text" name="address" placeholder="Address">
                <input type="text" name="town" placeholder="Town/City">
                <input type="text" name="postcode" placeholder="Postcode">
                <input type="text" name="telephone" placeholder="Telephone Number">
                <input type="text" name="email" placeholder="Email Address">
                <select name="industry">
                    <option value="beauty">Beauty</option>
                    <option value="fitness">Fitness</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="home-improvements">Home Improvements</option>                 
                    <option value="motoring">Motoring</option>
                    <option value="pet-care">Pet Care</option>
                    <option value="other">Other</option>     
                </select>
                <p>If other, please specify:</p>
                <input type="text" name="otherindustry" placeholder="Industry">
                
                <p>Please provide a list of services that you offer, and the average length of the appointment</p>
                
                <textarea name="services" placeholder="e.g MOT Check - 1 hour"></textarea>
                
                <input type="submit" name="submit" id="submit" value="Submit">
            
            </form>
        
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
    // Close alert box
    $(".closebtn").click(function(){
        $(".alert").hide('fast');
    });
    </script>
    
</body>
</html>
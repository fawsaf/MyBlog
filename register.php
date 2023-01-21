<?php
    require_once 'connect.php'; 
    require_once 'config.php';

?>
<title>PHP Blog</title>

<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/ui/trumbowyg.min.css">
</head>
<body>

<header class="w3-container w3-teal">
<h1>Blog System</h1>
</header>


<div style="position:absolute; left: 40%;">
<form action="./register.php" class="form" method="POST" class="w3-container w3-padding">  
    <h2 class="w3-container w3-teal">Create a new account</h2>  
        <label>Username </label>
		<input type="text" name="username" value="" placeholder="enter a username" autocomplete="off" required / class="w3-input w3-border">
        <label>Email Address </label>
		<input type="text" name="email" value="" placeholder="provide an email" autocomplete="off" required / class="w3-input w3-border">
        <label> Password </label>
		<input type="password" name="passwd" value="" placeholder="enter a password" autocomplete="off" required / class="w3-input w3-border">
	
		<p>password must be at least 5 characters and<br /> have a special character, e.g. !#$.,:;()</font></p>
        <label>Confirm Password </label>
		<input type="password" name="confirm_password" value="" placeholder="confirm your password" autocomplete="off" required / class="w3-input w3-border">
	
		<input type="submit" name="registerBtn" value="create account" / class="w3-btn w3-teal">
	
	<p class="center"><br />
		Already have an account? <a href="login.php">Login here</a>
	</p>
</form>
</div>

<div class="w3-container w3-teal" style="position:absolute; bottom: 5%; width: 100%">
    <p>All rights reserved | <?php echo date("Y"); ?></p>
</div>

<?php

if (isset($_POST['registerBtn'])){ 
    // get all of the form data 
    $username = $_POST['username']; 
    $email = $_POST['email']; 
    $passwd = $_POST['passwd']; 
    $passwd_again = $_POST['confirm_password']; 
    $date_created = date("Y/m/d h:i:sa");
   
    // next code block 
    if ($username != "" && $passwd != "" && $passwd_again != ""){
        // make sure the two passwords match
        if ($passwd === $passwd_again){
            // make sure the password meets the min strength requirements
            if ( strlen($passwd) >= 5 ){
                $qry_usr_chk = "SELECT * FROM users WHERE username='{$username}'";
                $result=mysqli_query($dbcon, $qry_usr_chk );
                if (mysqli_num_rows($result) == 0)
                {
                    $query="INSERT INTO users (username, password, email, date)
                     VALUES ('$username', '$passwd','$email' , '$date_created')";
                    mysqli_query($dbcon, $query);
                    $result = mysqli_query($dbcon, $qry_usr_chk);
                    if (mysqli_num_rows($result) == 1){
                        $success = true;
                        echo"Account successfully created";
                    }
                    else
                        echo'An error occurred and your account was not created.';
                }
                else
                    echo 'The username <i>'.$username.'</i> is already taken. Please use another.';
                }
            else
                echo 'Your password is not strong enough. Please use another.';
        }
        else
            echo 'Your passwords did not match.';
    }
    else
        echo 'Please fill out all required fields.';
}


?>
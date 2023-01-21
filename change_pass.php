<?php
require_once'connect.php';
$u_name=$_SESSION['username'];
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="images/style.css"> 
<div class="mainDiv">
  <div class="cardStyle">
    <form action="" method="post" name="signupForm" id="signupForm">
      
      <img src="" id="signupLogo"/>
      
      <h2 class="formTitle">
        Change Password
      </h2>
    <div class="inputDiv">
      <label class="inputLabel" for="password">Current Password</label>
      <input type="password" id="cur_password" name="cur_password" required>
    </div>

    <div class="inputDiv">
      <label class="inputLabel" for="password">New Password</label>
      <input type="password" id="password" name="password" required>
    </div>
      
    <div class="inputDiv">
      <label class="inputLabel" for="confirmPassword">Confirm Password</label>
      <input type="password" id="confirmPassword" name="confirmPassword">
    </div>
    
    <div class="buttonWrapper">
      <button type="submit" name="submit" id="submitButton" onclick="validateSignupForm()" class="submitButton pure-button pure-button-primary">
        <span>Continue</span>
        
      </button>
    </div>
      
  </form>
  </div>


<?php

if(isset($_POST['submit']))
{
    
    $cur_pass=$_POST['cur_password'];
    $pass=$_POST['password'];
    $conf_pass=$_POST['confirmPassword'];
    
    $query="select * from users where username='$u_name' and password='$cur_pass'";
    
    if(mysqli_num_rows(mysqli_query($dbcon,$query))==1)
    {
        if ($pass === $conf_pass){
            // make sure the password meets the min strength requirements
            if ( strlen($pass) >= 5 ){
                $query = "UPDATE users SET password='$pass' where username='$u_name'";
                $result = mysqli_query($dbcon, $query) or die(mysqli_error($db));   ?>

                <script type="text/javascript">
                alert("Update Successful.");
                window.location = "update_pro.php";
                </script>
                
                <?php }
            else echo'<div class="alert alert-warning" id="change" >password not strong enough</div>';
        }
        else
        
            echo'<div class="alert alert-warning" id="change">retype new password</div>';
        
    }
    else
        echo'<div class="alert alert-warning" id="change" >please enter the correct current password</div>';

}

?>


</div>
<?php
require_once 'connect.php';
require_once 'header.php';
function pass_verify($a,$b)
{
    if ($a==$b)
        return true;
}

echo '<h2 class="w3-container w3-teal" style="padding: 0.20em 16px;">Login</h2>';

if (isset($_POST['log'])) {
    $username =$_POST['username'];
    $password =$_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = '$username' and password='$password'";
    $result = mysqli_query($dbcon, $sql);
    
    $row = mysqli_fetch_assoc($result);
    
    $row_count = mysqli_num_rows($result);
    //var_dump(password_verify($password, $row['password'])) ;
    
    if ($row_count == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $row['id'];
        header("location: user.php");
    } else {
        
        echo "<div class='w3-panel w3-pale-red w3-display-container'>Incorrect username or password.</div>";
    }
}
print_r($_SESSION);
if (empty($_SESSION['username']))
{
    ?>

    <form action="" method="POST" class="w3-container w3-padding">
        <label>Username </label>
        <input type="text" name="username"  value="<?php if(isset($_POST['username'])){ echo strip_tags($_POST['username']);}?>" class="w3-input w3-border">
        <label>Password</label>
        <input type="password" name="password" class="w3-input w3-border">
        <p><input type="submit" name="log" value="Login" class="w3-btn w3-teal"></p>
    </form>
    <h3 style="text-align: center;">Do not have an account? Click here to 
    <strong style="color:blue"><a href="register.php">Signup</a></strong>!!
</h3>
    
 
    <?php
}
else
    echo "You are already logged in";
Include("footer.php");

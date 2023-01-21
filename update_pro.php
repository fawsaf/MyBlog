<?php
require_once 'header.php';
require_once 'connect.php';
$user_id=$_SESSION['id'];
?>

<h2 class='w3-container w3-teal w3-center' style='font-size: 200%; height: 40px;'>Update Profile</h2>

<div class="w3-container w3-sand w3-card-4">
        
        <form method="post" action="#" enctype="multipart/form-data" >
        <div id="brown" style="position:relative; left:16%; align-content: center;">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" style="width:20em;" placeholder="Enter your Fullname"  />
          </div>
          <div class="form-group">
            <p>Gender:</p>
            <input type="radio" id="male" name="gender" value="Male" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="Female" required>
            <label for="female">Female</label><br>
          </div>
          
        
        <div id="chris" style="position:absolute; left: 44%; top:0.1%;">

          <div class="form-group">
            <label>Age</label>
            <input type="number" class="form-control" name="age" style="width:20em;" placeholder="Enter your Age" >
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" style="width:20em;"  placeholder="Enter your Address" ></textarea>
          </div>
            
        </div>
        </div>
          <center>
            <input type="file" id="files" name="image" class="hidden"/>
            <label for="files" class="btn btn btn-success">Upload Profile Picture</label>
          </center>
          <div class="form-group" >
            <br>
            <input type="submit" name="submit" class="btn btn-primary"
             style="width:50%; position:relative; left:25%;" br><br>
            
          </div>
        </form>
      </div>
      <br>
      <a href="change_pass.php" class="w3-button w3-purple">Change Password</a>
    <?php
    
     if(isset($_POST['submit'])){

      
        
        $username = $_POST['username'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $address = $_POST['address'];

        $file_name=$_FILES['image']['name'];
        $file_tmp=$_FILES['image']['tmp_name'];
        move_uploaded_file($file_tmp,"images/". $file_name);
        

      $query = "UPDATE users SET username = '$username',
                      gender = '$gender', age = $age, address = '$address',dp='$file_name'
                      WHERE id = '$user_id'";
                    $result = mysqli_query($dbcon, $query) or die(mysqli_error($db));

          echo $result;
      ?>
                     <script type="text/javascript">
            alert("Update Successfull.");
            window.location = "user.php";
        </script>
  <?php
             }  
             include 'footer.php';             
?>  
 
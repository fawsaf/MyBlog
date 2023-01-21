<?php
require_once 'connect.php';
require_once 'header.php';
require_once 'security.php';
$u_name=$_SESSION['username'];
$pro=$_GET['author'];
?>

<h2 class='w3-container w3-teal w3-center'>Profile</h2>

<?php

    $query="select * from users where username='$pro'";
    $row=mysqli_fetch_assoc(mysqli_query($dbcon,$query));
    
    $username = $row['username'];
    $email = $row['email'];
    $gender = $row['gender'];
    $age = $row['age'];
    $address=$row['address'];
    $pathx = "images/";
    $dp=$row['dp'];
    $date=substr($row['date'],0,10);

    echo '<div class="w3-container w3-sand w3-card-4" >';
    echo'<div style="display:flex;align-items:center;">';
    echo '<img src="'.$pathx.$dp.'" width="300" height="200" >';

    echo "<div style='position:relative; left:20px;';><br>Username: $username";
    echo "<br>Gender: $gender";
    echo "<br>Age: $age";
    echo "<br>Address: $address";
    echo "<br>Join date: $date";
    echo"<br>";

$author=$_GET['author'];
$sub= $_SESSION['username'];
if($author!=$sub)
{
    $query="select * from subscription where author_name='$author' and sub_name='$sub'";
    $row_count = mysqli_num_rows(mysqli_query($dbcon,$query));
    if($row_count!=0)
    {
        echo'<form method="post"><input type="submit" class="btn btn-danger" name="unsub"value="Unsubscribe"/></form>';
    }
    else
        echo'<form method="post"><input type="submit" class="btn btn-success" name="sub"value="Subscribe"/></form>';
 
    $query="select * from users where username='$author'";
    $row = mysqli_fetch_assoc(mysqli_query($dbcon,$query));
    $author_id=$row['id'];
    $author_mail=$row['email'];
    $query="select * from users where username='$sub'";
    $row = mysqli_fetch_assoc(mysqli_query($dbcon,$query));
    $sub_id=$row['id'];
    $sub_mail=$row['email'];

    if(isset($_POST['sub']))
    {
        $query="insert into subscription values 
        (NULL,'$author_id','$author','$author_mail','$sub_id','$sub','$sub_mail')";
        mysqli_query($dbcon,$query);
        header("location:profile.php?author=$author");     

    }

    else if(isset($_POST['unsub']))
    {
        
        $query="delete from subscription where author_name='$author' and sub_name='$sub'";
        mysqli_query($dbcon,$query); 
        header("location:profile.php?author=$author");    
        

    }
}
?>
</div></div></div>
<div class='w3-container w3-teal w3-center'>
    <?php
    echo "<a href='/$url_path/profile.php?author=$author'
    class='w3-bar-item w3-btn'>Posts</a>";
    echo "<a href='/$url_path/profile.php?author=$author&sub=0'
    class='w3-bar-item w3-btn'>Subscribers</a>";         
    ?>
</div>

<?php
    if(isset($_GET['sub']))
    {
        $sql = "SELECT * FROM subscription where author_name='$author'";
        $result = mysqli_query($dbcon, $sql);
        if (mysqli_num_rows($result) < 1) {
            echo "No Subscriber yet";
        }
        else
        {
        echo "<br><table class='w3-table-all '><br>";
        echo "<tr class='w3-teal w3-hover-green'>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $id=$row['id'];
            echo "<td>$id</td>";
            $name=$row['sub_name'];
            echo "<td>$name</td>";
            $mail=$row['sub_mail'];
            echo "<td>$mail</td>";
            
        }
        }

    }
    else 
    {
        $query = "SELECT author_name FROM subscription where sub_name='$sub'";
    $row = mysqli_fetch_assoc(mysqli_query($dbcon,$query));
    if(mysqli_num_rows(mysqli_query($dbcon,$query))!=0)
        $valid_author=$row['author_name'];
    else
        $valid_author=NULL;
    
    echo $valid_author;
    $sql = "SELECT * FROM posts 
    where posted_by='$author' and (CURRENT_DATE-DATE(date)>1 OR posted_by='$valid_author')";
    $result = mysqli_query($dbcon, $sql);
    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['id'];
        $title = $row['title'];
        $des = strip_tags($row['description']);
        $slug = $row['slug'];
        $time = $row['date'];
    
        $permalink ="view.php?id=$id/$slug";
        
    
        echo '<div class="w3-panel w3-sand w3-card-4">';
        echo "<h3><a href='$permalink'>$title</a></h3><p>";
    
        echo substr($des, 0, 100);
    
        echo '<div class="w3-text-teal">';
        echo "<a href='$permalink'>Read more...</a></p>";
    
        echo '</div>';
        echo "<div class='w3-text-grey'> $time </div>";
        echo '</div>';
    }
    }

?>


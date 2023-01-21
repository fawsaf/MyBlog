<?php
require_once 'connect.php';
require_once 'header.php';

$u_id=$_SESSION['id'];
$id = (INT)$_GET['id'];
if ($id < 1) {
    header("location: $url_path");
}
$sql = "Select * FROM posts WHERE id = '$id'";
$result = mysqli_query($dbcon, $sql);

$invalid = mysqli_num_rows($result);
if ($invalid == 0) {
    header("location: $url_path");
}

if(isset($_POST['like']))
{
    $query="insert into likes values(NULL,'$u_id','$id')";
    mysqli_query($dbcon,$query);
}
if(isset($_POST['unlike']))
{
    $query="delete  from likes where userid='$u_id' and postid='$id'";
    mysqli_query($dbcon,$query);
    header("location:view.php?id=$id"); 
}

$query="select count(*) as cnt from likes where postid='$id'";

$ans=mysqli_fetch_assoc(mysqli_query($dbcon,$query));
$like_count=$ans['cnt'];


$hsql = "SELECT * FROM posts WHERE id = '$id'";
$res = mysqli_query($dbcon, $hsql);
$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$title = $row['title'];
$description = $row['description'];
$author = $row['posted_by'];
$pathx = "images/";
$img=$row['img'];
$link=$row['link'];
$cat=$row['post_cat'];
$time = $row['date'];


$r=mysqli_fetch_assoc(mysqli_query($dbcon,"select catname from category where id='$cat'"));
if($cat==0)
    $category='Unavailable';
else
    $category=$r['catname'];



echo '<div class="w3-container w3-sand w3-card-4">';

echo "<h3>$title</h3>";
echo '<div class="w3-panel w3-leftbar w3-rightbar w3-border w3-sand w3-card-4">';
echo "$description<br>";
if($img!="")
    {
        echo '<center><img src="'.$pathx.$img.'" width="800" height="500" ></center>';
    }
    
if($link!="")
    echo'<iframe width="600" height="300" src="'. $link .'"></iframe>';
echo '<div class="w3-text-grey">';
$query="select * from likes where userid='$u_id' and postid='$id'";
    $row_count = mysqli_num_rows(mysqli_query($dbcon,$query));
    if($row_count!=0)
    {
        echo'<form method="post"><input type="submit" class="btn btn-danger" name="unlike"value="Unlike"></form>';
    }
    else
        echo'<form method="post"><input type="submit" class="btn btn-success" name="like"value="like"></form>';

echo "Like count:(".$like_count.")<br>";        

echo"Category:";
echo'<a href="cat.php?id='.$cat.'">'.$category.'</a><br>';
echo "Posted by: <a href='/$url_path/profile.php?author=$author'>$author</a> <br>";
echo "$time</div>";

if (isset($_SESSION['username'])) {
    
   echo' <div class="w3-text-green">';
       echo "<br><a class='btn btn-info' href='/$url_path/edit.php?id= $row[id]'>Edit</a>
    ";
    echo "<a class='btn btn-danger' href='/$url_path/del.php?id= $row[id]'
           onclick=\"return confirm('Are you sure you want to delete this post?');\">Delete</a></div>";
           $url = "http://";   
           // Append the host(domain name, ip) to the URL.   
           $url.= $_SERVER['HTTP_HOST'];   
           
           // Append the requested resource location to the URL   
           $url.= $_SERVER['REQUEST_URI'];    
           echo'<br><a name="fb_share" class="btn btn-primary"  role="button" href="https://www.facebook.com/sharer.php?u='.$url.'">Share on Facebook</a>';
            echo"<br>";
 
}

echo '</div>';

?>


<div>
    Comment:
    
    <?php
    if(isset($_SESSION['username']))
        {
    ?>
        <br>
        <form method="post">
			
        <textarea  name="comment_content" rows="2" cols="44" style ="width:96%;height:90px;padding:2%;font-size:1.2em;background-color:aliceblue;" placeholder=".........Type your comment here........" required></textarea><br>
        <input style="font-size: 14px;border:5px dark;background-color:#15202B;color:white;" type="submit" name="comment">
			</form>				
		</br>
        
		<?php 
       
        $sql = "SELECT COUNT(*) FROM comment where post_id='$id'";
        $result = mysqli_query($dbcon, $sql);
        //var_dump($result);
        //echo"<br>";
        $r = mysqli_fetch_row($result);
        //print_r($r);

        $numrows = $r[0];
        
        //print_r($numrows);
        $rowsperpage = PAGINATION;
        $totalpages = ceil($numrows / $rowsperpage);

        $page = 1;

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = (INT)$_GET['page'];
        }

        if ($page > $totalpages) {
            $page = $totalpages;
        }

        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $rowsperpage;

        

            $query="SELECT *  FROM comment JOIN users on users.id = comment.user_id where post_id ='$id' 
            group by content order by date_posted desc LIMIT $offset, $rowsperpage ";
			$comment_query = mysqli_query($dbcon,$query);
            
            if (mysqli_num_rows($result) >0)
            {
                
                while ($comment_row=mysqli_fetch_assoc($comment_query))
                {
                $comment_id = $comment_row['comment_id'];
                $comment_by = $comment_row['username'];
                $comment_date=$comment_row['date_posted'];
                $content=$comment_row['content'];
                echo "<br>";
                //echo $comment_by.": ".$comment_row['content']."<br>";
                echo "<a href='update_pro.php'>$comment_by</a>";
                echo": $content <br>";
                echo $comment_date;
                echo "<br><br>";
                }

            }
            if ($numrows >0)
                    {
                        if ($page != $totalpages) {
                $nextpage = $page + 1;
                    echo "<a href='view.php?page=$nextpage&id={$_GET['id']}' class='w3-button w3-red'>Read 
                    more..</a>";
                }
            }
            
			if (isset($_POST['comment']))
            {
			    $comment_content = $_POST['comment_content'];
				$post_id=$_GET['id'];
                echo $post_id;
                $user_id=$_SESSION['id'];
                $date=date('jS M, Y - h:i:sa');
            
				mysqli_query($dbcon,"insert into comment (content,date_posted,user_id,post_id) values ('$comment_content','$date','$user_id','$post_id')");
                header('location: view.php?id='.$_GET['id']);
			}

        }
        else
        {
            echo "You have to login to comment";
        }
        
		?>
</div>

<?php 
    
    include("footer.php");

   

?>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
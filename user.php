<?php
require_once 'connect.php';
require_once 'header.php';
require_once 'security.php';
$u_name=$_SESSION['username'];
?>
<br>
<h2 class='w3-container w3-teal w3-center' style='font-size: 200%; height: 40px;'>User Profile</h2>
<p class="w3-center"><a href="update_pro.php" class="w3-button w3-green">Click Here to update your Profile</a></p>
<?php
    $query="select * from users where username='$u_name'";
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
    echo "<br>Join date: $date</div></div></div>";
    


?>



<h2 class='w3-container w3-teal w3-center' style='font-size: 200%; height: 40px;'>Posts</h2>
    
    <p class=w3-center ><a href="new.php" class="w3-button w3-pink">Create new post</a></p>
<?php
if($u_name=='Admin')
{
    $sql = "SELECT COUNT(*) FROM posts ";
    $result = mysqli_query($dbcon, $sql);
    $r = mysqli_fetch_row($result);

}
else
{
    $sql = "SELECT COUNT(*) FROM posts where posted_by='$u_name'";
    $result = mysqli_query($dbcon, $sql);
    $r = mysqli_fetch_row($result);
}
$numrows = $r[0];
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
if($u_name=='Admin')
{
    $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset, $rowsperpage";
    $result = mysqli_query($dbcon, $sql);
}
else{
    $sql = "SELECT * FROM posts where posted_by='$u_name' ORDER BY id DESC LIMIT $offset, $rowsperpage";
    $result = mysqli_query($dbcon, $sql);
}


if (mysqli_num_rows($result) < 1) {
    echo "No post found";
}
echo "<table class='w3-table-all'>";
echo "<tr class='w3-teal w3-hover-green'>";
echo "<th>ID</th>";
echo "<th>Title</th>";
echo "<th>Date</th>";
echo "<th>Action</th>";
echo "</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $title = $row['title'];
    $slug = $row['slug'];
    $author = $row['posted_by'];
    $time = $row['date'];

    $permalink="view.php?id=$id/$slug";
    ?>

    <tr>
        <td><?php echo $id; ?></td>
        <td><a href="<?php echo $permalink; ?>"><?php echo substr($title, 0, 50); ?></a></td>
        <td><?php echo $time; ?></td>
        <td><div class="btn btn-info"><a href="edit.php?id=<?php echo $id; ?>">Edit</a></div> | <div class="btn btn-danger"><a href="del.php?id=<?php echo $id; ?>"
                                                                   onclick="return confirm('Are you sure you want to delete this post?')">Delete</a></div>
        </td>
    </tr>

    <?php
}
echo "</table>";

// pagination
echo "<p><div class='w3-bar w3-center'>";
if ($page > 1) {
    echo "<a href='?page=1' class='w3-btn'><<</a>";
    $prevpage = $page - 1;
    echo "<a href='?page=$prevpage' class='w3-btn'><</a>";
}
$range = 3;
for ($i = ($page - $range); $i < ($page + $range) + 1; $i++) {
    if (($i > 0) && ($i <= $totalpages)) {
        if ($i == $page) {
            echo "<div class='w3-btn w3-teal w3-hover-green'> $i</div>";
        } else {
            echo "<a href='?page=$i' class='w3-btn w3-border'>$i</a>";
        }
    }
}
if ($page != $totalpages) {
    $nextpage = $page + 1;
    echo "<a href='?page=$nextpage' class='w3-btn'>></a>";
    echo "<a href='?page=$totalpages' class='w3-btn'>>></a>";
}
echo "</div></p>";
include("footer.php");

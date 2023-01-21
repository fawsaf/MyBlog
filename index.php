<?php
require_once 'connect.php';
require_once 'header.php';
?>

<form action="search.php" method="GET" class="w3-container">
            <p>
                <input type="text" name="q" id="search_user" class="w3-input w3-border" placeholder="Search for anything" required>
            </p>
            <p>
            <input type="submit" class="w3-btn w3-teal w3-round" value="Search">
            
            </p>
        </form>

<?php

print_r($_SESSION);
if(isset($_SESSION['username']))
    $u_name= $_SESSION['username'];
else 
    $u_name=NULL;
// COUNT
$sql = "SELECT COUNT(*) FROM posts";
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

$query = "SELECT author_name FROM subscription where sub_name='$u_name'";
$row = mysqli_fetch_assoc(mysqli_query($dbcon,$query));
if(mysqli_num_rows(mysqli_query($dbcon,$query))!=0)
    $author=$row['author_name'];
else
    $author=NULL;


$sql = "SELECT * FROM posts 
where (CURRENT_DATE-DATE(date) >1 OR posted_by='$u_name' OR posted_by='$author')
ORDER BY id DESC LIMIT $offset, $rowsperpage";
$result = mysqli_query($dbcon, $sql);

if (mysqli_num_rows($result) < 1) {
    echo '<div class="w3-panel w3-pale-red w3-card-2 w3-border w3-round">No post yet!</div>';
} else {
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


echo "<p><div class='w3-bar w3-center'>";

if ($page > 1) {
    echo "<a href='?page=1'>&laquo;</a>";
    $prevpage = $page - 1;
    echo "<a href='?page=$prevpage' class='w3-btn'><</a>";
}

$range = 3; #how many next pages to show after curren page
for ($x = $page - $range; $x < ($page + $range) + 1; $x++) {
    if (($x > 0) && ($x <= $totalpages)) { #if range 3 $x=1-3=-2 to 1+3+1=5 means it will run for 1 to 4
        if ($x == $page) {
            echo "<div class='w3-teal w3-button'>$x</div>"; 
        } else {
            echo "<a href='?page=$x' class='w3-button w3-border'>$x</a>";
        }
    }
}

if ($page != $totalpages) {
    $nextpage = $page + 1;
    echo "<a href='?page=$nextpage' class='w3-button'>></a>";
    echo "<a href='?page=$totalpages' class='w3-btn'>&raquo;</a>";
}

echo "</div></p>";
}

//include("categories.php");
include("footer.php");
?>
<script type="text/javascript">
      $(function() {
         $( "#search_user" ).autocomplete({
           source: "auto_complete.php",
         });
      });
    </script>
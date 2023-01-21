<?php
require_once 'connect.php';
require_once 'header.php';

echo'<form action="search.php" method="GET" class="w3-container">
            <p>
                <input type="text" name="q" id="search_user" class="w3-input w3-border" placeholder="Search for anything" required>
            </p>
            <p>
            <input type="submit" class="w3-btn w3-teal w3-round" value="Search">
            
            </p>
        </form>';
if (isset($_GET['q'])) {
    $q = $_GET['q'];

    $sql = "SELECT * FROM posts WHERE title LIKE '%{$q}%' OR description LIKE '%{$q}%'";
    $result = mysqli_query($dbcon, $sql);

    $sql2 = "SELECT * FROM users WHERE username='{$q}'";
    $result2 = mysqli_query($dbcon, $sql2);

    if (mysqli_num_rows($result) < 1  && mysqli_num_rows($result2) < 1) {
        echo "Nothing found.";
    } 
    else if(mysqli_num_rows($result2)== 1)
    {
      echo "<div class='w3-panel w3-sand w3-card-4'>
      <a href='/$url_path/profile.php?author=$q'>$q</a> </div><br>";
    }
    else {

      echo "<div class='w3-container w3-padding'>Showing results for $q</div>";
      

      while ($row = mysqli_fetch_assoc($result)) {

        $id = htmlentities($row['id']);
        $title = htmlentities($row['title']);
        $des = htmlentities(strip_tags($row['description']));
        $slug = htmlentities(strip_tags($row['slug']));
        $time = htmlentities($row['date']);

        $permalink = "view.php?id=".$id ."/".$slug;

        echo '<div class="w3-panel w3-sand w3-card-4">';
        echo "<h3><a href='$permalink'>$title</a></h3><p>";

        echo substr($des, 0, 100);

        echo '</p><div class="w3-text-teal">';
        echo "<a href='$permalink'>Read more...</a>";

        echo '</div> <div class="w3-text-grey">';
        echo "$time</div>";
        echo '</div>';

      }

    }
}
include("footer.php");
?>

<script type="text/javascript">
      $(function() {
         $( "#search_user" ).autocomplete({
           source: "auto_complete.php",
         });
      });
    </script>
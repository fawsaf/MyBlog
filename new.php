<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/trumbowyg.min.js"></script>
<!-- <script src="trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js"></script> -->

<script>
    
    $('#description').trumbowyg();
</script>
<?php
require_once 'connect.php';
require_once 'header.php';
require_once 'security.php';

if (isset($_POST['submit'])) {
    $title =$_POST['title'];
    $description = $_POST ['description'];
    $slug = slug($title);
    $date = date('Y-m-d H:i');
    $posted_by =$_SESSION['username'];
    $category=$_POST['category'];
    $link=$_POST['link'];
    $link=str_replace("watch?v=","embed/",$link);

    $file_name=$_FILES['image']['name'];
    $file_size=$_FILES['image']['size'];
    $file_tmp=$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    move_uploaded_file($file_tmp,"images/". $file_name);
    echo $file_name;

    $sql = "INSERT INTO posts (title, description, slug,post_cat,posted_by,img,link, date) VALUES('$title', '$description', '$slug','$category', '$posted_by','$file_name','$link', '$date')";
    mysqli_query($dbcon, $sql) or die("failed to post" . mysqli_connect_error());

  

    printf("Posted successfully");

} else {
    ?>
    <div class="w3-container">
        <div class="w3-card-4">
            <div class="w3-container w3-teal">
                <h2>New Post</h2>
            </div>

            <form class="w3-container" method="POST" enctype="multipart/form-data">

                <p>
                    <label>Title</label>
                    <input type="text" class="w3-input w3-border" name="title" required>
                </p>

                <p>
                    <label>Description</label>
                    <textarea id = "description" row="30" cols="50" class="w3-input w3-border" name="description" required/></textarea>
                    <input type="file" name="image">
                    <label><br>Video Link</label>
                    <input type="text" class="w3-input w3-border" name="link">
                    <label for="category">
                    <p>Category list:
                    1:Horror,2:Tech,3:Sports,4:Philosophy</p></label>
                    <input type="number"name="category" min="1" max="4">
                </p>
                <p>
                    <input type="submit" class="w3-btn w3-teal w3-round" name="submit" value="Post">
                </p>
            </form>

        </div>
    </div>
    <?php
}

include("footer.php");

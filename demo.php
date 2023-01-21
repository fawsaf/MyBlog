<?php
require_once 'functions.php';
require_once 'connect.php';
require_once 'config.php';

if (!empty(SITE_ROOT)){
    $url_path = SITE_ROOT;
    
} else{
    $url_path = "/";
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" ,initial-scale=1">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/ui/trumbowyg.min.css">
</head>
<body>

<header class="w3-container w3-teal">
    <h1>Blog System</h1>
    <h4 style="text-align:right;"> <?php if (isset($_SESSION['username'])) {
                                                echo 'Welcome '.$_SESSION['username']."!!";}
                                            ?> </h4>
</header>


<div class="w3-bar w3-border">
    <?php
    echo "<a href='/$url_path/' class='w3-bar-item w3-button w3-pale-green'>Home</a>";
    
    if (isset($_SESSION['username'])) {
        echo "<a href='/$url_path/new.php' class='w3-bar-item w3-btn'>New Post</a>";
        
        if($_SESSION['username']=='Admin')
            echo "<a href='/$url_path/user.php' class='w3-bar-item w3-btn'>Admin Panel</a>";
        else
            echo "<a href='/$url_path/user.php' class='w3-bar-item w3-btn'>User Panel</a>";
        echo "<a href='/$url_path/Categories.php' class='w3-bar-item w3-btn'>Categories</a>";
        echo "<a href='/$url_path/logout.php' class='w3-bar-item w3-btn'>Logout</a>";
        echo'<div class="w3-container">
        <form action="search.php" method="GET" class="w3-container">
            <p>
                <input type="text" name="q" id="search_user" class="w3-input w3-border" placeholder="Search for anything" required>
            </p>
            <p>
            <input type="submit" class="w3-btn w3-teal w3-round" value="Search">
            
            </p>
        </form>
    
    </div>';
 
    } else {
        echo "<a href='/$url_path/login.php' class='w3-bar-item w3-pale-red' >Login</a>";

       
    }
    ?>
    
</div>
<script type="text/javascript">
    
      $(function() {
         $( "#search_user" ).autocomplete({
            
           source: "auto_complete.php",
         });
      });
    </script>

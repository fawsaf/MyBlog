<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db = 'newblog';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass , $db) or die($conn);

function users($conn , $term){   
    $query = "SELECT * FROM users WHERE username LIKE '%".$term."%' ORDER BY username ASC";
    $result = mysqli_query($conn, $query);  
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    return $data;   
}

if (isset($_GET['term'])) {
    $users = users($conn, $_GET['term']);
    $getusers = array();
    foreach($users as $user){
        $getusers[] = $user['username'];
    }
    echo json_encode($getusers);
}

?>
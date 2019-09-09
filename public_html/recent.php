<?php
session_start();
$mysqli = new mysqli('localhost', 'root', 'ashraygupta', 'webkriti');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $mysqli->real_escape_string($_POST['title']);
    $description = $mysqli->real_escape_string($_POST['description']);
    $image_path = $mysqli->real_escape_string('images/'.$_FILES['image']['name']);
    $user_id=$_SESSION['id'];
        $sql = "INSERT INTO posts (postTitle, postCont, postimage,user_id) VALUES ('$title','$description','$image_path','$user_id')";
        if($mysqli->query($sql) == true)
        {
        header("location:profile.php");
        }
}
?>
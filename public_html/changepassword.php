<?php
session_start();
$mysqli = new mysqli('localhost', 'root', 'ashraygupta', 'webkriti');
 if(isset($_POST['submit'])){
     $username = $_SESSION['username'];
     $password = md5($_POST['currentpassword']);
     $newpassword = md5($_POST['newpassword']);
     $confirmnewpassword = md5($_POST['confirmnewpassword']);
    $sql  ="SELECT password FROM users WHERE username='$username'";
    $data = mysqli_query($mysqli, $sql);
     while($row = mysqli_fetch_array($data)){
        $oldpassword=$row['password'];
        //echo $oldpassword;
     }
     if($password==$oldpassword){
            if($newpassword==$confirmnewpassword){
                $querychange=mysqli_query($mysqli,"UPDATE users SET password='$newpassword' WHERE username='$username'");
            }
            else{
            die("new password don't match<a href='profile.php'>RETURN</a> to the profile page.");
        }
                              
session_destroy();
                die("your password has been changed.<a href='profile.php'>RETURN</a> to the main page and log in again."); 
            }
            else{
            die("old password doesn't match .<a href='profile.php'>RETURN</a> to the profile page");
        }
     }
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Amigos</title>
        <link rel="icon" href="camera.jpg">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <div>
            <form class="form" action="changepassword.php" method="post" enctype="multipart/form-data" autocomplete="off">
<!--                     <div class="alert alert-error"><?= $_SESSION['message']?></div>
 -->                    <input type="password" placeholder="Enter current password" name="currentpassword"id="currentusername" required/>
                    <input type="password" placeholder="new password" name="newpassword"id="newpassword" required/>
        <input type="password" placeholder="Confirm new Password" name="confirmnewpassword"id="confirmnewpassword" autocomplete="new-password" required/>
      <input type="Submit"name="submit"value="Submit" class="btn btn-block btn-primary">
                </form>
        </div>
        
    </body>
</html>

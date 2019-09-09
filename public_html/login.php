<?php
session_start();
$_SESSION['message']='';
$mysqli = new mysqli('localhost', 'root', 'ashraygupta', 'webkriti');
      if(isset($_POST['submit'])){
          $username = $_POST['username'];
          
          $password = md5($_POST['password']);
          $query = "SELECT * FROM users WHERE username='$username' && password='$password'";
              $data = mysqli_query($mysqli,$query);
             while($row = mysqli_fetch_assoc($data)) {
                 $idd=$row["id"];
                 $avatar_path=$row['avatar'];
                 $email = $row['email'];
             }
               $total = mysqli_num_rows($data);
              if($total == 1)
              { 
                  $_SESSION['username']=$username;
                  $_SESSION['email'] = $email;
                   $_SESSION['avatar']=$avatar_path;
                 $_SESSION['signed_in']=true;
                 $_SESSION['id']=$idd;
                  header("location:profile.php");
              }
              else{
                echo "<script>
                     window.location.href='index.php';
                 alert('USERNAME NOT FOUND!!');
                
                     </script>";
              }
      }
  ?>
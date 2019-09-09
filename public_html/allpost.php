 <?php
        session_start();
        if(isset($_SESSION['signed_in'])!=true){
            header("location:index.php");
        }
         $mysqli = new mysqli('localhost', 'root', 'ashraygupta', 'webkriti');
         $id=$_SESSION['id'];
        $query="SELECT Count(postID) as totalposts FROM users,posts WHERE id=user_id AND user_id='$id'";
         ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Amigos</title>
        <link rel="icon" href="camera.jpg">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"> 
    </head>
    <body>
         <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Nav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div>
                        <a href="http://localhost/webdevprojects/webkriti/webkriti/public_html/#"><img src="amigos.png" id="logoami"></a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="Nav" >
                    <ul class="nav navbar-nav navbar-right">   
                        <li><a href="profile.php" id="id11" class="id11"><span class="glyphicon glyphicon-user"></span> <span><?=$_SESSION['username'] ?></span></a></li>
                        <li><a href="logout.php"id="id12"class="id12"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>

                    </ul>
               </div>
               </div>      
        </nav> 
<?php
                                    $mysqli = new mysqli('localhost', 'root', 'ashraygupta', 'webkriti');
                                    $query="SELECT * FROM users,posts WHERE id=user_id ORDER BY postID desc";
                                    $data = mysqli_query($mysqli,$query);
                                    $p = 2;
                                         while($row = mysqli_fetch_assoc($data)) {
                                        $p++;
                                    $content=$row['postCont'];
                                    $username=$row['username'];
                                    $title=$row['postTitle'];
                                    $image=$row['postimage'];
                                    ?>     
        <div class="container" data-toggle="modal" data-target="#myModal<?php echo $p; ?>" style="padding-top: 50px; ">
            <div class="images2">
                        <a href="#">
                                <div class="thumbnail">
                                    <center><p class="gy" style="font-size:20px; font-family:MV Boli "> <?php echo $title; ?> </p></center>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="<?php echo $image;?>" class="img-responsive img-rounded">
                                    </div>
                                </div>
                                    <center>  <p> by- <?php echo $username;?> </p>      </center>
                    </div>
                </a>
            </div>
        </div>
    <div class="container">
    <div class="modal fade" id="myModal<?php echo $p; ?>" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b> 
                  <center>
                       <?php echo $title; ?>
                  </center>
                </b></h4>
        </div>
        <div class="modal-body">
          <img src="<?php echo $image;?>" class="img-responsive img-rounded"width="250"height="100"style="float:left; text-align: justify;";
                 margin-right:10px; margin-botton:5px;position:relative;top:20%;">
                <p style="font-family: Agency FB; text-align:justify; "> <?php echo $content; ?></p>
        </div>
        <div class="modal-footer">
            <p style="float: left;" > by- <?php echo $username;?></p>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
    </div>
            <?php
       }
       ?>
    </body>
</html>
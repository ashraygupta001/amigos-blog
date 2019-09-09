 <?php
        session_start();
        if(isset($_SESSION['signed_in'])!=true){
            header("location:index.php");
        }
        $mysqli = new mysqli('localhost', 'root', '', 'modernhospital');
        $docid=$_SESSION['docid'];
        $query="SELECT Count(postID) as totalposts FROM users,posts WHERE id=user_id AND user_id='$id'";
        $data = mysqli_query($mysqli,$query);
        while($row = mysqli_fetch_assoc($data)){
$total=$row['totalposts'];            
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>hospital</title>
        <link rel="icon" href="sh.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
            <script rel="stylesheet" src="http://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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
                     <div class="dropdown">
                        <li><a href="#" id="id11" class="id11"><span class="glyphicon glyphicon-user"></span> <span><?=$_SESSION['username'] ?></span></a></li>
                         <div class="dropdown-content">
                             <span><h6><?=$_SESSION['docemail'] ?></h6></span>
                             <a href="changepassword.php" class="id25" id="id25"> <center> <p>change password</p> </center></a> 
                             <center>  <p> Total no. of posts <?php echo $total;?>  </p> </center>
                         </div>
                     </div>
                                                <li><a href="logout.php"id="id12"class="id12"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>

                    </ul>
               </div>
               </div>      
        </nav> 
    </body>
    </html>
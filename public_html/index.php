<?php
session_start();
$_SESSION['message']='';
$mysqli = new mysqli('localhost', 'root', 'ashraygupta', 'webkriti');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //if two password are equal
if($_POST['password'] == $_POST['confirmpassword']){ 
$username = $mysqli->real_escape_string($_POST['username']);
$email = $mysqli->real_escape_string($_POST['email']);
$password = md5($_POST['password']);
$avatar_path = $mysqli->real_escape_string('images/'.$_FILES['avatar']['name']);
if (preg_match("!image!",$_FILES['avatar']['type'])){
    if (copy($_FILES['avatar']['tmp_name'],$avatar_path)){
      
        $sql = "INSERT INTO users (username, email, password, avatar) VALUES ('$username','$email','$password','$avatar_path')";
        //echo $sql; exit(1);
        if($mysqli->query($sql) === true){
            $idd=$mysqli->insert_id;
           
            $_SESSION['username']=$username;
        $_SESSION['avatar']=$avatar_path;
        $_SESSION['signed_in']=true;
         $_SESSION['id']=$idd;
            header("location: profile.php");
        }
        else{
            $_SESSION['message']="User could not be added to the database!";
        }
    }
    else{
        $_SESSION['message']="File upload failed!";
    }
}
else{
    $_SESSION['message']="Please only upload GIF,JPG, or PNG images!";
}
}
else{
    $_SESSION['message']="Two passwords do not match! ";
}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Amigos</title>
        <link rel="icon" href="sh.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"> 
        <style>.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}


        </style>
 
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
                        <a href="http://localhost/webdevprojects/webkriti/webkriti/public_html/"><img src="amigos.png" id="logoami"></a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="Nav" >
                    <ul class="nav navbar-nav navbar-right">
                        
                        <?php
                            if(isset($_SESSION['signed_in'])==true){
                                ?>
                        <li style="hidden"><a style="cursor:none;" href="#"id="id01"class="id01"></a></li>
                        <li style="hidden"><a style="cursor:none;" href="#"id="button"class="button"></a></li>
                        <li><a href="profile.php"id="id11"class="id11"><span class="glyphicon glyphicon-user"></span> <span><?=$_SESSION['username'] ?></span></a></li>
                        <li><a href="logout.php"id="id12"class="id12"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                        
                    
                        <?php
                            }
                            else{
                                ?>
                        <li><a href="#"id="id01"class="id01"><span class="glyphicon glyphicon-user"></span> Sign Up </a> </li>
                        <li><a href="#"id="button"class="button"><span class="glyphicon glyphicon-log-in"></span> Login </a></li>
                    
                        
                        <?php
                            }
                        ?>
                        </ul>
                </div>             
            </div>
        </nav>
       
        <div class="background">
            <img src="4.png" class="img-responsive s jo"> 
            <img src="6.jpg" class="img-responsive s jo">
            <img src="5.jpg" class="img-responsive s jo"> 
            <button class="btn" onClick="plusIndex(-1)" id="btn1">&#10094;</button>
             <button class="btn" onClick="plusIndex(1)" id="btn2">&#10095;</button>
        </div>
           <div class="bg-modal">
              <div class="modal-contents">
            <div class="close">+</div>
                <span class="glyphicon glyphicon-user"></span>
                <form action="login.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="alert alert-error"><?= $_SESSION['message']?></div>
                    <input type="text" required name="username"placeholder="Enter Username"id="username">   
                    <input type="Password" required name="password" placeholder="Enter Password"id=""pswrd><br>
                        <input type="Submit"name="submit"value="Submit"><br>
                        <p>Don't have an account!<a href="#"id="id02"class="id02">Sign Up </a></p>
		</form>
            </div>
          </div>
        <div class="bg-model">
	<div class="model-contents">
            <div class="clase">+</div>
                <span class="glyphicon glyphicon-user"></span>
                <form class="form" action="index.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="alert alert-error"><?= $_SESSION['message']?></div>
          <input type="text" placeholder="Enter Username" name="username"id="username" required/>
        <input type="email" placeholder="Enter Email" name="email"id="email" required/>
        <input type="password" placeholder="Enter Password" name="password"id="password"autocomplete="new-password" required/>
        <input type="password" placeholder="Confirm Password" name="confirmpassword"id="confirmpassword" autocomplete="new-password" required/>
<div class="avatar"><label>select your avatar:</label><input type="file" name="avatar" accept="image/*" required/></div>
      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
      <input type="Submit"name="submit"value="Submit" class="btn btn-block btn-primary">
                </form>
      </div>
        </div>
        <div class="container">
            <div class="row images ">
                <a href="#"id="id07" class="id07"><div class="col-sm-4">
                    <div class="thumbnail">
                   <img src="1.jpg" class="img-responsive img-thumbnail">
                    <div class="caption">
                        <center>
                            <h3>
                                Solo Trip
                            </h3>
                            <p style="font-family: Agency FB">the best solo trips.</p>
                        </center>
                </div>
                    </div>
                </div>
                </a>
                <a href="#"id="id08"class="id08"><div class="col-sm-4">
                    <div class="thumbnail">
                    <img src="2.jpg" class="img-responsive img-thumbnail">
                    <div class="caption">
                        <center>
                            <h3>
                                Couple Trip
                            </h3>
                            <p style="font-family: Agency FB">The best couple trip</p>
                        </center>
                    </div>
                    </div>
                </div>
                </a>
                <a href="#"id="id09"class="id09"><div class="col-sm-4">
                    <div class="thumbnail">
                   <img src="3.jpg" class="img-responsive img-thumbnail">
                    <div class="caption">
                        <center>
                            <h3>
                                Friends
                            </h3>
                            <p style="font-family: Agency FB">Trip for Friends</p>
                        </center>                     
                    </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
  
            <div class="container ws">
                <div style="    width: 25%;
    margin-left: auto;
    margin-right: auto;
    display: block;">
                    <center>
                    <h2 class="popularposts" style="padding: 20px; background-color: #eee;">
                        Must read
                    </h2>
                    </center>                 
                </div>  
            </div>
            <div class="container">
                <div class="row images1">
                            <a href="#"id="id03"class="id03"
                               ><div class="col-sm-3">
                                    <div class="thumbnail">   
                                        <img src="7.jpg" class="img-responsive img-rounded">
                                        <div class="caption">
                                            <center>
                                            <h4>
                                                <b>AFRICA</b>
                                            </h4>
                                            <p style="font-family: Agency FB; text-align:justify;">
                                               Africa is the world's second largest and second most-populous continent, being behind Asia in both categories.AFRICA IS GREAT BEST.
                                            </p>
                                            </center>
                                        </div>                                     
                           </div>
            </div>
                            </a>
                            <a href="#" id="id04"class="id04"><div class="col-sm-3">
                                    <div class="thumbnail">
                                        <img src="8.jpg" class="img-responsive img-rounded">
                                        <div class="caption">
                                            <center>
                                                <h4>
                                                    <b>CANADA</b>
                                                </h4>
                                                <p style="font-family: Agency FB; text-align:justify;">
                                                    Canada (/ˈkænədə/; Canadian French: [kanadɑ]) is a country in the northern part of North America.
                                                </p>
                                            </center>
                                        </div>                                    
                                    </div>                                      
                        </div>    
                    </a>
                    <a href="#"id="id05" class="id05"><div class="col-sm-3">
                                    <div class="thumbnail">
                                        <img src="9.jpg" class="img-responsive img-rounded">
                                        <div class="caption">
                                            <center>
                                                <h4>
                                                    <b>CUBA</b>
                                                </h4>
                                                <p style="font-family: Agency FB; text-align:justify;">
                                                    Cuba officially the Republic of Cuba is a country comprising the island of Cuba as well as Isla de .
                                                </p>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                    </a>
                            <a href="#"id="id06" class="id06"><div class="col-sm-3">
                                    <div class="thumbnail">
                                        <img src="10.jpg" class="img-responsive img-rounded">
                                        <div class="caption">
                                            <center>
                                                <h4>
                                                    <b>INDIA</b>
                                                </h4>
                                                <p style="font-family: Agency FB; text-align:justify;">India (IAST: Bhārat), also known as the Republic of India (IAST: Bhārat Gaṇarājya),[18][e] is a country </p>
                                            </center>
                                        </div>
                                    </div>
                        </div>
                    </a>
                </div>
            </div>
         <div class="a">
	<div class="a1">
            <div class="close1">+</div>
            <div class="row">
            <img src="7.jpg"class="img-responsive img-rounded"width="350"height="380"style="float:left;
                 margin-right:10px; margin-botton:5px;position:relative;top:20%;">
            <h3 id="africa"><b>AFRICA</b></h3>
            <p style="font-family: Agency FB; text-align:justify;">Africa is the world's second largest and second most-populous continent, being behind Asia in both categories. At about 30.3 million km2 (11.7 million square miles) including adjacent islands, it covers 6% of Earth's total surface area and 20% of its land area.[3] With 1.2 billion people[1] as of 2016, it accounts for about 16% of the world's human population. The continent is surrounded by the Mediterranean Sea to the north, the Isthmus of Suez and the Red Sea to the northeast, the Indian Ocean to the southeast and the Atlantic Ocean to the west. The continent includes Madagascar and various archipelagos. It contains 54 fully recognised sovereign states (countries), nine territories and two de facto independent states with limited or no recognition.[4] The majority of the continent and its countries are in the Northern Hemisphere, with a substantial portion and number of countries in the Southern Hemisphere.Africa's average population is the youngest amongst all the continents;[5][6] the median age in 2012 was 19.7, when the worldwide median age was 30.4.[7] Algeria is Africa's largest country by area, and Nigeria is its largest by population. Africa, particularly central Eastern Africa, is widely accepted as the place of origin of humans and the Hominidae clade (great apes), as evidenced by the discovery of the earliest hominids and their ancestors as well as later ones that have been dated to around 7 million years ago, including Sahelanthropus tchadensis, Australopithecus africanus, A. afarensis, Homo erectus, H. habilis and H. ergaster—the earliest Homo sapiens (modern human), found in Ethiopia, date to circa 200,000 years ago.[8] Africa.</p>
            </div>
            </div>
         </div>
                 <div class="a2">
	<div class="a3">
            <div class="close2">+</div>
            <div class="row">
            <img src="8.jpg"class="img-responsive img-rounded"width="350"height="380"style="float:left;
                 margin-right:10px; margin-botton:5px;position:relative;top:20%;">
            <h3 id="africa"><b>CANADA</b></h3>
            <p style="font-family: Agency FB; text-align:justify; ">Canada (/ˈkænədə/; Canadian French: [kanadɑ]) is a country in the northern part of North America. Its ten provinces and three territories extend from the Atlantic to the Pacific and northward into the Arctic Ocean, covering 9.98 million square kilometres (3.85 million square miles), making it the world's second-largest country by total area. Canada's southern border with the United States is the world's longest bi-national land border. Its capital is Ottawa, and its three largest metropolitan areas are Toronto, Montreal, and Vancouver. As a whole, Canada is sparsely populated, the majority of its land area being dominated by forest and tundra. Consequently, its population is highly urbanized, with over 80 percent of its inhabitants concentrated in large and medium-sized cities, many near the southern border. Canada's climate varies widely across its vast area, ranging from arctic weather in the north, to hot summers in the southern regions, with four distinct seasons.

Various indigenous peoples have inhabited what is now Canada for thousands of years prior to European colonization. Beginning in the 16th century, British and French expeditions explored, and later settled, along the Atlantic coast. As a consequence of various armed conflicts, France ceded nearly all of its colonies in North America in 1763. In 1867, with the union of three British North American colonies through Confederation, Canada was formed as a federal dominion of four provinces. This began an accretion of provinces and territories and a process of increasing autonomy from the United Kingdom. This widening autonomy was highlighted by the Statute of Westminster of 1931 and culminated in the Canada Act of 1982, which severed the vestiges of legal dependence on the British parliament.</p>
            </div>
            </div>
         </div>
         <div class="a4">
	<div class="a5">
            <div class="close3">+</div>
            <div class="row">
            <img src="9.jpg"class="img-responsive img-rounded"width="350"height="380"style="float:left;
                 margin-right:10px; margin-botton:5px;position:relative;top:20%;">
            <h3 id="africa"><b>CUBA</b></h3>
            <p style="font-family: Agency FB; text-align:justify; ">Cuba (/ˈkjuːbə/ (About this soundlisten); Spanish pronunciation: [ˈkuβa]), officially the Republic of Cuba (Spanish: About this soundRepública de Cuba (help·info)), is a country comprising the island of Cuba as well as Isla de la Juventud and several minor archipelagos. Cuba is located in the northern Caribbean where the Caribbean Sea, Gulf of Mexico and Atlantic Ocean meet. It is east of the Yucatán Peninsula (Mexico), south of both the U.S. state of Florida and the Bahamas, west of Haiti and north of both Jamaica and the Cayman Islands. Havana is the largest city and capital; other major cities include Santiago de Cuba and Camagüey. The area of the Republic of Cuba is 110,860 square kilometres (42,800 sq mi) (109,884 square kilometres (42,426 sq mi) without the territorial waters). The island of Cuba is the largest island in Cuba and in the Caribbean, with an area of 105,006 square kilometres (40,543 sq mi), and the second-most populous after Hispaniola, with over 11 million inhabitants.[12]

The territory that is now Cuba was inhabited by the Ciboney Taíno people from the 4th millennium BC until Spanish colonisation in the 15th century.[13] From the 15th century, it was a colony of Spain until the Spanish–American War of 1898, when Cuba was occupied by the United States and gained nominal independence as a de facto United States protectorate in 1902. As a fragile republic, in 1940 Cuba attempted to strengthen its democratic system, but mounting political radicalization and social strife culminated in a coup and subsequent dictatorship under Fulgencio Batista in 1952.[14] Open corruption and oppression under Batista's rule led to his ousting in January 1959 by the 26th of July Movement, which afterwards established communist rule under the leadership of Fidel Castro.[15][16][17] Since 1965, the state has been governed by the Communist Party of Cuba.</p>
            </div>
            </div>
         </div>
        <div class="a6">
	<div class="a7">
            <div class="close4">+</div>
            <div class="row">
            <img src="10.jpg"class="img-responsive img-rounded"width="350"height="380"style="float:left;
                 margin-right:10px; margin-botton:5px;position:relative;top:20%;">
            <h3><b>INDIA</b></h3>
            <p style="font-family: Agency FB; text-align:justify; ">India (IAST: Bhārat), also known as the Republic of India (IAST: Bhārat Gaṇarājya),[18][e] is a country in South Asia. It is the seventh largest country by area and with more than 1.3 billion people, it is the second most populous country and the most populous democracy in the world. Bounded by the Indian Ocean on the south, the Arabian Sea on the southwest, and the Bay of Bengal on the southeast, it shares land borders with Pakistan to the west;[f] China, Nepal, and Bhutan to the northeast; and Bangladesh and Myanmar to the east. In the Indian Ocean, India is in the vicinity of Sri Lanka and the Maldives, while its Andaman and Nicobar Islands share a maritime border with Thailand and Indonesia.

The Indian subcontinent was home to the urban Indus Valley Civilisation of the 3rd millennium BCE. In the following millennium, the oldest scriptures associated with Hinduism began to be composed. Social stratification, based on caste, emerged in the first millennium BCE, and Buddhism and Jainism arose. Early political consolidations took place under the Maurya and Gupta empires; later peninsular Middle Kingdoms influenced cultures as far as Southeast Asia. In the medieval era, Judaism, Zoroastrianism, Christianity, and Islam arrived, and Sikhism emerged, all adding to the region's diverse culture. Much of the north fell to the Delhi Sultanate; the south was united under the Vijayanagara Empire. The economy expanded in the 17th century in the Mughal Empire. In the mid-18th century, the subcontinent came under British East India Company rule, and in the mid-19th under British crown rule.</p>
            </div>
            </div>
         </div>
                <div class="a8">
	<div class="a9">
            <div class="close5">+</div>
            <div class="row">
            <img src="1.jpg"class="img-responsive img-rounded"width="350"height="380"style="float:left;
                 margin-right:10px; margin-botton:5px;position:relative;top:20%;">
            <h3 id="africa"><b>SOLO TRIP</b></h3>
            <p style="font-family: Agency FB; text-align:justify; ">Solo travel gives you ultimate freedom. You wake up and it’s just you — what you want, where you want, when you want. In that freedom and infinite space of possibility, you meet yourself. You hit the limits of what you like and don’t like. There’s no one to pull you in any one direction or override your reasons. Want sushi? Get sushi. Want to leave? Leave. Want to try bungee jumping? Go for it.

It’s sink or swim and you have to learn how to survive — who to trust, how to make friends, how to find your way around alone. That’s the greatest reward of solo travel: the personal growth. Each time you go away, you learn to become a little more independent, confident, and in tune with your emotions and desires.

Solo travel is not for everyone. Some people return home soon after departing, others cry for weeks before embracing it, and some just embrace it right away. But you’ll never learn that if you don’t travel once by yourself. Whether a weekend away, a two-week vacation, or trip around the world, try it at least once.</p><a href="https://www.nomadicmatt.com/travel-blogs/why-solo-travel/" target="_blank"><p>Read more......</p></a>
            </div>
            </div>
         </div>
         <div class="a10">
	<div class="a11">
            <div class="close6">+</div>
            <div class="row">
            <img src="2.jpg"class="img-responsive img-rounded"width="350"height="380"style="float:left;
                 margin-right:10px; margin-botton:5px;position:relative;top:20%;">
            <h3><b>COUPLE TRIP</b></h3>
            <p style="font-family: Agency FB; text-align:justify; ">We were schoolmates, friends, we dated for eons, and then got married. Our passports are full of bruises and stamps because we’ve been travelling extensively for over 12 years now! Together we’ve been to over 80 countries and hundreds of cities. But it was only seven years AFTER we first started travelling together that we decided to start our own blog to pen our favourite things about the world for fellow travellers.Gradually, it transitioned into a full-time profession for both of us. Bruised Passports has all the details you would need to plan a trip to a new country – itineraries, accommodation suggestions, packing guides, and tips for budgeting. But Bruised Passports isn’t just about travel.</p><a href="https://www.bruisedpassports.com/who-are-savi-vid"target="_black"><p>Read more.....</p></a>
            </div>
            </div>
         </div>
                 <div class="a12">
	<div class="a13">
            <div class="close7">+</div>
            <div class="row">
            <img src="3.jpg"class="img-responsive img-rounded"width="350"height="380"style="float:left;
                 margin-right:10px; margin-botton:5px;position:relative;top:20%;">
            <h3><b>FRIENDS TRIP</b></h3>
            <p style="font-family: Agency FB; text-align:justify; ">While traveling solo or with your significant other can be fun, there’s something about going on a trip with your best friends. From Vegas to Greece to Australia, there’s so much of the world that is better to see with your friends by your side.

Here are some of the best destinations to visit with your best friend!Mardi Gras aka “Fat Tuesday” is the last day for Catholics to indulge before Lent begins. In New Orleans, this means masked balls, colorful parades, loud music, and beaded necklaces.

If you can swing it, try staying in the French Quarter or in a hotel that’s walking distance. They close down the French Quarter to vehicular traffic and taxis are few and far between.Greece has become the ultimate hot spot for beach parties, and each year Mykonos beach bar parties get better and better. With tourists touching down every single day, it’s no wonder that world-famous DJs stop by to play.

All of the beach bars in Mykonos will give you a direct view of the Aegean Sea making it the perfect place to grab a few drinks and dance the night away.</p><a href="https://theblondeabroad.com/the-ultimate-best-friend-travel-bucket-list/" target="_blank"><p>Read more....</p></a>
            </div>
            </div>
         </div>
        <div style="    width: 20%;
    margin-left: auto;
    margin-right: auto;
    display: block;">
                <h2 class="popularposts">
                    <p style="padding: 30px;background-color: #eee; ">  Recent posts</p>
                </h2>
        </div>

                               <?php
                                    $mysqli = new mysqli('localhost', 'root', 'ashraygupta', 'webkriti');
                                    $query="SELECT * FROM users,posts WHERE id=user_id ORDER BY postID desc LIMIT 4";
                                    $data = mysqli_query($mysqli,$query);
                                    $p = 2;
                                         while($row = mysqli_fetch_assoc($data)) {
                                        $p++;
                                    $content=$row['postCont'];
                                    $username=$row['username'];
                                    $title=$row['postTitle'];
                                    $image=$row['postimage'];
                                    ?>     
        <div class="container" data-toggle="modal" data-target="#myModal<?php echo $p; ?>">
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
    <div style="padding-bottom:10px;">
    <a href="allpost.php">
        <center>
            <button type="button" class="btn btn-info btn-lg">
        Read all posts
    </button>
        </center>
    </a>
    </div>
        <div class="h">
     <center><h1 class="yu" style="font-size:62px; ">AMIGOS</h1></center>
          </div>
        <div class="footer" >
                <center>
                    <div style="background-color: #000;height: 20px;">
                        <p style="color: white;">Copyright © Amigos. All Rights Reserved | Contact Us: +91 90000 00000</p>
                </div>
                </center>
        </div> 
         <script type="text/javascript" src="logics.js"></script>      
    </body>
</html>
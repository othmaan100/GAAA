<?php
session_start();

if(!isset($_SESSION['user_session']))
{
  //$_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
	header("Location: ../login.html");
}

include_once '../dbconfig.php';

$stmt = $db_con->prepare("SELECT * FROM employee WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);


$qr = $db_con->prepare("SELECT * FROM questions LIMIT 10");
$qr->execute();

$count = $qr->rowCount();
$qrow=$qr->fetch(PDO::FETCH_ASSOC);
				
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>0nline Aptitude Test</title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<script type="text/javascript" src="../js/jquery-1.11.3-jquery.min.js"></script>
<link href="../style.css" rel="stylesheet" media="screen">
<style type="text/css">
      
      #header{
        height: 50px;
        padding: 10px;
        background-color: #755;
        border-bottom: 2px inset #aaaaaa;
        border-bottom-style: groove;
        color: #eee;
      }
      #header nav{
        background: black;
      }
      #navbar a{
        color: #eee;
      }
       #navbar ul.dropdown-menu li a{
        color: #000;
      }

.class{
    position: relative;
    width: 100%;
}
.caption {
    position: absolute;
    background-color: transparent;
    bottom: 0;
    top: 34%;
    z-index: 5;
}
.caption{
    max-width: 500px;
}
.caption-home{

    left: 52%;
}
.image{
  position: relative;
  background-size: cover;
  width: auto;
  height: auto;
  max-width: 100%;
  vertical-align: middle;
}
h1 {
display: block;
font-size: 2em;
-webkit-margin-before: 0.67em;
-webkit-margin-after: 0.67em;
-webkit-margin-start: 0px;
-webkit-margin-end: 0px;
font-weight: bold;
}
.caption h1 {
color: black;
font-size: 400%;
font-weight: 400;
line-height: 1.25;
margin: 0;
text-shadow: 0 1px 1px rgba(0, 0, 0, 0.4);
}
.caption p{
    color: black;
    font-size: 1em;
}
#blue-band-holder p {
color: white;
font-size: 22px;
text-align: center;
margin: 0;
}
.site-full-width{
    background: black;
    height: 4em;
    margin-top:5px;
    }
	
.starttest {
	width:590px;
	padding:20px;
	margin: 0 auto;
	border: 5px solid #00AFF2;
	text-align:center;
}
.starttest h2{
	font-size:20px;
	margin-buttom:10px;
	padding-buttom:10px;
	border-bottom:1px solid #ddd;
}
.starttest  ul{
	margin: 0px;
	padding: 0px;
	list-style:none;
}
.starttest ul li{
	margin-top:5px;
}
.starttest a{
	background:#f4f4f4 none repeat scroll 0 0;
	display:block;
	margin-top:10px;
	border:1px solid ddd;
	background:#f4f4f4;
	text-decoration:none;
	padding:6px 10px;
	text-align:center;
	color:#444;
}
  </style>
</head>

<body>
<header id="header">
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Online Exam Portal</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <?php
            if($row['status']=='1'){
	
        echo '<li ><a href="test2.php" onclick="return false;">Start test</a></li>';
            }else {
                echo '<li ><a href="test2.php" >Start test</a></li>';
            }
            ?>
            <li><a href="profile.php">View Profile</a></li>
			
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $row['fname']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Edit Profile</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</header>        
            <div class="item active">
                     <div class="containerx">

                            <!--<div class="caption page-carousel pull-left">-->
                            <div class="caption caption-home home-carousel ">
								<div class="starttest">
                                      <!-- value: 0--><h2 color="black">Welcome to Online Exam -- Final </h2>
                                  
												<p>Congrats I You have Just completed the test.</p>
												<p>Your Test Score is:
												<?php
												if (isset($_SESSION['score'])) {
												echo round(($_SESSION['score']/$count*10),2).'';
												unset($_SESSION['score']);
												}
												?> 
												</p>
                                    </div>
									</div>
				
                            <div class="image" style="width:100%; min-height:570px;">
                            
                         <!--   <img alt="wr slider" class="attachment-slider wp-post-image" src="../images/bglight2.jpg" height="520px;"> -->
                            
                            </div>     

                              <div class="site-full-width darkbluecolor">
                                <div class="container">
                                   <div class="row">
                                      <div class="col-md-12">

                             <div id="blue-band-holder">
                                <!-- value: 0--><p>Online  Examination Software</p>
                                           </div>



                          </div>

                    </div>
                  </div>
               </div>
              </div>
            </div>
        </div>  
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php
session_start();


if (isset($_GET['q'])) {
$number = (int)$_GET['q'];
}else{
header('Location : index.php');
}
if(!isset($_SESSION['user_session']))
{
  //$_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
	header("Location: ../login.html");
}

include_once '../dbconfig.php';




$stmt = $db_con->prepare("SELECT * FROM tbl_admin WHERE aid=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

$qr = $db_con->prepare("SELECT * FROM questions ");
$qr->execute();

$count = $qr->rowCount();
$qrow=$qr->fetch(PDO::FETCH_ASSOC);

$qst = $db_con->prepare("SELECT * FROM questions where quesNo='$number' ");
$qst->execute();
$qstrow=$qst->fetch(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>online recruitment</title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<script type="text/javascript" src="../js/jquery-1.11.3-jquery.min.js"></script>
<link href="../style.css" rel="stylesheet" media="screen">
<style type="text/css">
      body {
    background-image: url("../images/bglight2.jpg");
	background-repeat: repeat;
} 
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
          <a class="navbar-brand" href="#"><div id="hms">00:01:00</div></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            
            <li><a href="profile.php">View Profile</a></li>
			
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $row['username']; ?>&nbsp;<span class="caret"></span></a>
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
			<?php 
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$ans=$_POST['ans'];
					$number=$_POST['number'];
					$next = $number+1;
					
					if (!isset($_SESSION['score'])){
							$_SESSION['score'] = '0';
					}
$qrs = $db_con->prepare("SELECT * FROM questions ");
$qrs->execute();

$counts = $qrs->rowCount();

$sqlans= "SELECT * FROM answers where quesNo='$number' and right_ans='1'";	
	foreach ($db_con->query($sqlans) as $rowsans) {
		if($ans==$rowsans['ans_id']){
			$_SESSION['score']++;
		}
		
		if($number==$count){
			header('location:final.php');
			exit();
		}else{
			header('location:test.php?q='.$next);
		}
		
	}
				}
			?>
                     <div class="containerx" style="height:530px;">
				<div class="image" style="width:100%">
					 <div class="main">
					 
							<hl> Question <?php echo $number ?> of <?php echo $count; ?></hl>
								<div class="test">
									<form method="post" action="">
										<table>
											<tr>
												<td coLspan=”2”>
											<h3>Que <?php echo $qstrow['quesNo']; ?>: <?php echo $qstrow['ques']; ?></h3>
											</td>
											</tr>
										<?php 						
			$sqla= "SELECT * FROM answers where quesNo='$number'";
			
											
				foreach ($db_con->query($sqla) as $rowsa) {
								 ?>
							<tr>
												<td>
			<input type="radio" name="ans" value=" <?php  echo $rowsa['ans_id']; ?>"/> <?php  echo $rowsa['ans']; ?>
												</td>
											</tr>
											<?php } ?>
											<tr>
											<td>
                     <input type="submit" id="btn_next" name="submit" value="Next Question"/>
				<input type="hidden" name="number" value="<?php echo $number ?>"/>
						</td>
											</tr>
											
											</table>
											 
                            <!--<div class="caption page-carousel pull-left">-->
                            
                            
                            </div>   

                              <div class="site-full-width darkbluecolor">
                                <div class="container">
                                   <div class="row">
                                      <div class="col-md-12">

                             <div id="blue-band-holder">
                                <!-- value: 0--><p>Recruitment Advertising and Software Solutions for In-House Recruiters, HR teams and SMEs</p>
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

    <script>
$(document).ready(function(){
	function count(){
            var startTime = document.getElementById('hms').innerHTML;
            var pieces= startTime.split(":");
            
            var time = new Date();
            time.setHours(pieces[0]);
           console.log( time.setMinutes(pieces[1]));
            time.setSeconds(pieces[2]);
            
           
             console.log( time.setMinutes(pieces[1]));
            
            var timedif = new Date(time.valueOf() - 1000);
            var newTime=timedif.toTimeString().split(" ")[0];
            
            document.getElementById('hms').innerHTML=newTime;
            
         
           if(newTime==="00:00:00"){
                clearTimeout(time_out);
                $('#btn_next').css('display',' none');
                alert("Sorry Your time is over");
                
            }  
            time_out= setTimeout(count,1000);
            
            
            
        }
        count();
	
    }); 
   
   /*timer*/
/*
      var seconds = 10;
      function secondPassed() {
          var minutes = Math.round((seconds - 30)/60),
              remainingSeconds = seconds % 60;

          if (remainingSeconds < 10) {
              remainingSeconds = "0" + remainingSeconds;
          }

          document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
          if (seconds == 0) {
              clearInterval(countdownTimer);
              $('#btn_next').css('display',' none');
                alert("Sorry Your time is over");
             //form1 is your form name
            //document.form1.submit();
          } else {
              seconds--;
          }
      }
      var countdownTimer = setInterval('secondPassed()', 1000); */
    
    </script>
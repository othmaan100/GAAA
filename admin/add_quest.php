<?php
session_start();

if(!isset($_SESSION['admin_session']))
{
  //$_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
	header("Location: ../login.html");
}

include_once '../dbconfig.php';

$stmt = $db_con->prepare("SELECT * FROM tbl_admin WHERE aid=:uid");
$stmt->execute(array(":uid"=>$_SESSION['admin_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);


$qr = $db_con->prepare("SELECT * FROM questions where 1");
$qr->execute();
$count = $qr->rowCount();
$next= $count+1;

			
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
      body {
   // background-image: url("../images/bglight2.jpg");
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
.table{
	width: 40%
	/* border: 1px solid #E5E5E5; */
	
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

input[type="text"]{
	border: 1px solid #E5E5E5;
	margin-button:10px;
	padding: 5px;
	width:356px;
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
          <a class="navbar-brand" href="index.php">Online Exam Portal</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a href="index.php">Home</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li class="active"><a href="select_level.php">Add Question</a></li>
            <li><a href="quest_list.php"> Questions List</a></li>
            <li ><a href="view_result.php"> View Candidates Result</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $row['username']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</header>        
            <div class="item active">
                     <div class="container">
					
					 <div class="display ">
							<div class="row">
							<div class="col-md-12">
							<?php  
					if(isset($_GET['msg'])){
						if ($_GET['msg']=='1'){
							echo '<span class="col-md-3 col-md-offset-4 alert-success"> Question Added Succeessfully...</span>';
						}else
							echo	'<span class="alert-warning"> Question Not Added Succeessfully...</span>';
					 } 
					 ?>
					 </div>
					 </div>
                                             <div style=" min-height: 529px; margin-top: 20px;">



<?php 

    if (isset($_POST['level'])) {
      $level=$_POST['level'];
      $_SESSION['level']=$level;

    //  $_SESSION['user_session'] = $row['id'];
      
    }

 ?>

                          <form name="add_quest" method="post" action="add_quest_exe.php" enctype="application/x-www-form-urlencoded">

                              <table class="table table-bordered" align="center" border=" 10"> 
			<!--	<tr>
						<td>
						
                                                    <label class=" control-label" for="quesNo">Question No :</label>
						</td>
						<td>
                                          -->           <input type="hidden" class="  col-md-3" size="5" id="quesNo" name="quesNo"   value="<?php 	if(isset($next)){ echo $next;}?>"  maxlength="30" />
					<!--	</td>
				</tr>-->
				<tr>
                                    <td> <label class=" control-label" for="ques">Question:</label> </td>
						<td>
                                                    <input type="text" class=" form-control" name="ques"  id="ques"  />
						</td>
				</tr>
				<tr>
                                    <td> <label class=" control-label" for="op1"> Choice One:</label></td>
                                    <td><input type="text"  class=" form-control" name="ans1"  id="op1"  /></td>
				</tr>
				<tr>
                                    <td> <label class=" control-label" for="op2">Choice Two: </label></td>
                                    <td><input type="text" class="form-control" name="ans2"  id="op2"  /></td>
				</tr>
				<tr>
                                    <td> <label class=" control-label" for="op3">Choice Three:</label> </td>
                                    <td><input type="text" class=" form-control" name="ans3"  id="op3"  /></td>
				</tr>
				<tr>
                                    <td> <label class=" control-label" for="op4">Choice Four:</label></td>
                                    <td><input type="text" class=" form-control" name="ans4"  id="op4"  /></td>
				</tr>
				<tr>
                                    <td> <label class=" control-label" for="crt">Correct  No:</label></td>
					<td> <input type="number" name="rightAns"  id="crt"  /></td>
				</tr>
				<tr>
					<td colspan=2 align="center"><button name="add" class="btn btn-default">Add Question</button> </td>
					
				</tr>
	
			</table>
			</form>
</div>
</div>
                           <!-- <div class="image" style="width:100%">
                            
                           <img alt="wr slider" class="attachment-slider wp-post-image" src="../images/bglight2.jpg" height="520px;"> 
                            
                            </div>      -->

                              
           </div>           
         
       
	<footer>
	<div class="site-full-width darkbluecolor">
                             <div id="blue-band-holder" style="/*margin-top:100px;*/">
                            <p>Online Promotion Examination Software</p>
                                           </div>
	   </div>
         
	
      </footer>    
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php 

		
 ?>
 

<?php
session_start();
$msg="";
if(!isset($_SESSION['admin_session']))
{
  //$_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
	header("Location: ../login.html");
}

include_once '../dbconfig.php';
// for admin header
$stmt = $db_con->prepare("SELECT * FROM tbl_admin WHERE aid=:uid");
$stmt->execute(array(":uid"=>$_SESSION['admin_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['dis'])){
	$disId=(int)$_GET['dis'];
	$disable= "update employee set status='1' where id='$disId'";
	$disbled =$db_con->query($disable);
	/*
	if($disbled){
		$msg='<span class="success"> User Disabled !</span>';
		return $msg;
	}else{
		$msg=' <span class="error"> User Not Disabled !</span>';
		return $msg;
	}
*/
}

if(isset($_GET['ena'])){
	$enaId=(int)$_GET['ena'];
	$enable= "update employee set status='0' where id='$enaId'";
	$enabled =$db_con->query($enable);
	/*
	if($enabled){
		$msg=' <span class="success"> User Enabled !</span>';
		return $msg;
	}else{
		$msg=' <span class="error"> User Not Enabled !</span>';
		return $msg;
	}
*/
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Users</title>
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
	
.success{
	color:green;
	display:block;
	padding-bottom:5px;
	
}	
.error{
	color:red;
	display:block;
	padding-bottom:5px;
	
}	

.tblone{
	width:100%;
	border:1px solid #fff;
	margin:20px 0;
	}
.tblone td {
	font-size: 15px;
	padding: 5px 10px;
}
	table.tblone th {
	background-color: #d0d0d0;
	border: 2px solid #ffffff;
	text-align: center
	}
	
	table.tblone tr:nth-child(2n+1){background:#fff;height:30px;}
	table.tbLone tr:nth-child(2n){background:#f1f1f1;height:30px;}
.tbLone td a{color:#3399FF;}

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
            <li class="active" ><a href="manage_users.php">Manage Users</a></li>
            <li><a href="select_level.php">Add Question</a></li>
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
			 <div class="container" style="min-height: 550px;" >
			 <h1> Admin Panel - Manage Users</h1>
			 <?php

			
				echo $msg;
			

?>
			 
			<div class="manageuser">
			<table class="tblone" > 
				<tr>
							<th>
							S/N
							</th>
							<th>
							Full Name
							</th>
							<th>
							Class
							</th>
							<th>
							Email
							</th>
							<th>
							Action
							</th>
				</tr>
				<?php
			$sql= "SELECT * FROM employee";
			
			$i=0;
			foreach ($db_con->query($sql) as $rows) {
				++$i
?>
					<tr >
						<td>
						
						<?php 
						if($rows['status']=='1'){
							echo '<span class="error"> '.$i.' </span>';
						}else{
							echo $i;
						}
						?>
						</td>
						<td>
						<?php echo $rows['fname'];?>
						</td>
						<td>
						<?php echo $rows['class'] ;?>
						</td>
						<td>
						<?php echo $rows['gender'];?>
						</td>
						<td align="center">
						<?php

if($rows['status']=='0'){ ?>
	<a onclick="return confirm('Are You sure to Disable')" href="?dis=<?php echo $rows['id'] ?>" > Disable</a> 
	
<?php

} else{

?>
	<a  onclick="return confirm('Are You sure to Enable')" href="?ena=<?php echo $rows['id'] ?>" > Enable</a>  
<?php

}

?>
        ||  <a href="delusers.php?id=<?php echo $rows['id'] ?>" onclick="return confirm('Are You sure to Delete User?')"> Remove</a>
		 ||  <a href="profile.php?id=<?php echo $rows['id'] ?>" > View Profile</a>

						</td>
				</tr>
			<?php

			}

?>
			</table>
			</div>
				  </div>
					<div class="image" style="width:100%">
					
					
					
					</div>     

					  <div class="site-full-width darkbluecolor">
						<div class="container">
						   <div class="row">
							  <div class="col-md-12">

					 <div id="blue-band-holder">
						<!-- value: 0--><p>Online Promotion Examination Software</p>
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
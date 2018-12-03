<?php
session_start();

if(!isset($_SESSION['user_session']))
{
  //$_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
  header("Location: login.html");
}

include_once '../dbconfig.php';
$empid=$_SESSION['user_session'];


$stmt = $db_con->prepare("SELECT * FROM employee WHERE email=:uemail");
$stmt->execute(array(":uemail"=>$_SESSION['user_email']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
var_dump($row);
$state_stmt = $db_con->prepare("SELECT * FROM states inner join locals on states.state_id=locals.state_id WHERE states.state_id=:state ");
$state_stmt->execute(array(":state"=>$row['stateid']));
$state_row=$state_stmt->fetch(PDO::FETCH_ASSOC);
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
        background-color: black;
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
      .datatable, th{
        color: black;
      }
      .emp{
        text-align: center;
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
    width: 20%;
    color: black;
}
.caption-home{

    left: 53%;

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
color: #fff;
font-size: 400%;
font-weight: 400;
line-height: 1.25;
margin: 0;
text-shadow: 0 1px 1px rgba(0, 0, 0, 0.4);
}
.caption p{
    color: #fff;
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
           <?php
            if($row['status']=='1'){
	
        echo '<li ><a href="test2.php" onclick="return false;">Start test</a></li>';
            }else {
                echo '<li ><a href="testX.php" >Start test</a></li>';
            }
            ?>
            <li class="active"><a href="profile.php">View Profile</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $row['email']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;Edit Profile</a></li>
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
                            <div class="caption caption-home home-carousel pull-right" width="90%">
                                <table class="datatable"  >

                                      <h3 class="col-md-12 alert alert-success">Employee Profile</h3>
                                      <tr>
                                        <td>Full Names</td>
                                        <td><?php echo ucfirst($row['fname'])." ".ucfirst($row['lname']); ?></td>
                                      </tr>
                                      <tr>
                                        <td>State</td>
                                        <td><?php echo ucfirst($state_row['statename']); ?></td>
                                      </tr>
                                      <tr>
                                        <td>Email</td>
                                        <td><?php echo $row['email']; ?></td>
                                      </tr>
                                      <tr>
                                        <td>Qualifications  </td>
                                        <td style=" text-align: center;"><?php echo ' '.$row['qualification']; ?></td>
                                      </tr>
                                      <tr>
                                        <td>Discipline </td>
                                        <td><?php echo ' '.$row['discipline']; ?></td>
                                      </tr>
                                      <tr>
                                       <!-- <td><a href="edit.php?id=<?php echo $row['id']; ?>" class="btn alert-warning" style="//background:#ddd;margin-top:5px;font-size:1em;color:#222;">Edit Profile</a></td>-->
                                      </tr>
                                </table>
                                 </div>

                           <div class="image" style="width:100%; min-height:570px;"> 
                            
                            </div>     

                              <div class="site-full-width darkbluecolor">
                                <div class="container">
                                   <div class="row">
                                      <div class="col-md-12">

                             <div id="blue-band-holder">
                                <!-- value: 0--><p> Online  Examination Software</p>
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
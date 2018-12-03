<?php
session_start();

//if(!isset($_SESSION['user_session']))
//{
  //$_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
  //header("Location: login.html");
//}

include_once '../dbconfig.php';

$stmt = $db_con->prepare("SELECT * FROM tbl_admin WHERE aid=:uid");
$stmt->execute(array(":uid"=>$_SESSION['admin_session']));
$rowa=$stmt->fetch(PDO::FETCH_ASSOC);

  //if(isset($_GET['id'])){
    //$_SESSION['id']=$_GET['id'];
  //}
  
//if (isset($_SESSION['id'])){
  //$id_to_view = $_SESSION['id'];


//$stmt = $db_con->prepare("SELECT * FROM employee WHERE id='$id_to_view'");
//$stmt = $db_con->prepare("SELECT * FROM employee WHERE id=:uemail");
//$stmt->execute(array(":uemail"=>$id_to_view));

//$stmt->execute($stmt);
$row=$stmt->fetch(PDO::FETCH_ASSOC);

$state_stmt = $db_con->prepare("SELECT * FROM states WHERE state_id=:state");
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
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="select_level.php">Add Question</a></li>
  <li><a href="quest_list.php"> Questions List</a></li>
        <li><a href="view_result.php"> View Candidates Result</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $rowa['username']; ?>&nbsp;<span class="caret"></span></a>
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
                     <div class="containerx">

                            <div class="container" style="margin-top:20px;">
                           <!-- <div class="caption caption-home home-carousel " width="90%">-->
                               
                                      <div class=" col-md-offset-03">
                                      <form method="post" action="add_quest.php">
                                        <select name="level" class="form-control">
                                          <option value="">--Select Level---</option>
                                            <?php 
                                              $i=1;
                                              for ($i=0; $i <= 3; $i++) { 
                                                # code...
                                                ?>
                                              <option value="SS<?php echo $i; ?>">SS<?php echo "$i"; ?></option>
                                             
                                              <?php 
                                                  }

                                              ?>
                                        </select>
                                     </div>
                                     <br>
                                     <button type="submit" class="btn btn-success">Submit</button>
                                      </form>
                                 </div>

                           <div class="image" style="width:100%; min-height:500px;"> 
                            
                            </div>     

                              <div class="site-full-width darkbluecolor">
                                <div class="container">
                                   <div class="row">
                                      <div class="col-md-12">

                             <div id="blue-band-holder">
                                <!-- value: 0--><p> Online Promotion Examination Software</p>
                                        </div>



                          </div>

                    </div>
                  </div>
               </div>
              </div>
            </div>
        </div>  
<script src="../bootstrap/js/bootstrap.min.js"></script>

<?php// } ?>
</body>
</html>
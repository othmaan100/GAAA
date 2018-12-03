<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> </title>
<link rel="stylesheet" type="text/css" href="bootstrap\css\bootstrap.min.css">
<script type="text/javascript" src="bootstrap\js\jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="bootstrap\js\bootstrap.min.js"></script>
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
          <a class="navbar-brand" href="index.php">Online </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="add_quest.php">Add Question</a></li>
	<li><a href="quest_list.php"> Questions List</a></li>
        <li><a href="view_result.php"> View Candidates Result</a></li>
            
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
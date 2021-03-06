<!DOCTYPE html>
<html lang="en">
<head>
	<title>Online  Examination Software</title>
	<meta charset="utf-8">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
	<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="js/validation.min.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen">
	<script type="text/javascript" src="js/adScript.js"></script>
	<style type="text/css">
			body { background: url(images/bglight2.jpg); height: 500px; }
			#header{
				height: 100px;
				padding: 10px;
				background-color: black;
				border-bottom: 2px inset #aaaaaa;
				border-bottom-style: groove;
			}
			#header h1{
				font-size: 3em;
				color: #bbbbbb;
				font-style: unset;
			}
			#login_div{
				width: 40%;
				margin: 60px auto;
				border: 1px outset #dddddd;
				border-radius: 20px;
				border-style: groove;
				background-color: #efefef;
			}
			#login_div h1{
				text-align: center;
				color: black;
			}
			#login_div hr{
				height: 5px;
				background-color: black;
				border-radius: 10px;
			}
			input[type='text'],input[type='password']{
				border-radius: 50px;
				
				border-style: groove;
				border: 1px solid black;
			}
			button#btn-login{
				border-radius: 50px;
				background: black;
				border: 0;
			}
			button#btn-login:hover{
				background: #001;
			}
			#login_div hr#under{
				height: 2px;
				background-color: black;
				border-radius: 10px;
				margin: 2px;
			}
			.caption {
    position: absolute;
    background-color: transparent;
    bottom: 0;
    top: 34%;
    z-index: 5;
}
.class{
    position: relative;
    width: 100%;
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
    background:#755;
    height: 4em;
    margin-top:5px;
    }
	</style>
</head>
<body>
	
	<div class="container-fluid text-center">    
  		<div class="row">
	    	<div class="jumbotron" id="header"> 
	      		<div><h1>GOMBE ACADEMY</h1></div>
	      	</div>
      	</div>
    </div>
    <div class="container">
    	<div class="row">
    		<div class="container" id="login_div"> 
      			<div><h1><span class="glyphicon glyphicon-user"></span>&nbsp; Login</h1><div>
      			<hr>
      			<div id="error">
		        <!-- error will be shown here ! -->
		        </div>
      			<form role="form" class="form-horizontal" method="POST" id="login-form" 
      					action=""><!--Employee Reg Form-->
        		<div class="form-group">
          			<label for="username" class="control-label col-sm-4" >Username:</label>
          			<div class="col-sm-8">
            			<input type="text" class="form-control" id="username" name="username" pattern="">
            			<span id="check-e"></span>
            		</div>
            	</div>
            	<div class="form-group">
          			<label for="pwd" class="control-label col-sm-4" >Password:</label>
          			<div class="col-sm-8">
            			<input type="password" class="form-control" id="pwd" name="pwd" pattern="">
            		</div>
            	</div>
            	<div class="form-group"> 
		          <div class="col-sm-offset-4 col-sm-4">
		 <button type="submit" class="btn btn-block btn-default btn-success" id="btn-login" name="btn-login"><span class="glyphicon glyphicon-log-in"></span> &nbsp;  Login</button>
		          </div>
		        </div>
            	</form>
            	<hr id="under">
            		<div class="text-center"><span>User Login? <b><a href="login.html">Click Here</a></b></span></div>
            		<hr id="under">
            	
            </div>
          </div>
        </div>
    </div>

    
             
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
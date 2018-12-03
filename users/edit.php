<?php
include('connection.php');

if(isset($_POST['cancel'])){
	header('Location:index.php');
}
if(isset($_GET['id']))
{
  $id=$_GET['id'];
  if(isset($_POST['submit'])){

  	$fname=mysql_real_escape_string($_POST['fname']);
	$lname=mysql_real_escape_string($_POST['lname']);
	$oname=mysql_real_escape_string($_POST['oname']);
	$title=mysql_real_escape_string($_POST['title']);
	$gender=mysql_real_escape_string($_POST['gender']);
	$mstatus=mysql_real_escape_string($_POST['mstatus']);
	$dob=mysql_real_escape_string($_POST['dob']);
	$stateid=mysql_real_escape_string($_POST['stateid']);
	$qualification=mysql_real_escape_string($_POST['qualification']);
	$email=mysql_real_escape_string($_POST['email']);

	$updated=mysql_query("update  employee set fname ='$fname', lname ='$lname'
					, oname = '$oname', title = '$title', gender = '$gender', marital_status = '$mstatus'
					, dob = '$dob', stateid = '$stateid', qualification = '$qualification', email = '$email'  WHERE email = '$email'") 
		or die("unable to update this record!! ". mysql_error());

		if($updated){
			header('Location:index.php');
		}

 }
}
?>

	<?php
		if(isset($_GET['id']))
  {
  	$id=$_GET['id'];
  	$getselect=mysql_query("SELECT e.employee,e.fname,e.lname,e.oname,e.title
									,e.gender,e.marital_status,e.dob,e.qualification
									,e.stateid,e.email,s.statename
                                    FROM employee  AS e
                                    LEFT JOIN state AS s 
                                    ON e.stateid = s.stateid 
                                    WHERE id ='$id'");
  	$profile=mysql_fetch_array($getselect);
  
  		$fname=$profile['fname'];
		$lname=$profile['lname'];
		$oname=$profile['oname'];
		$dob=$profile['dob'];
		$id=$profile['id'];
		$title=$profile['title'];
		$stateid=$profile['stateid'];
		$statename=$profile['statename'];
		$qualification=$profile['qualification'];
		$gender=$profile['gender'];
		$mstatus=$profile['marital_status'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>0nline Aptitude Test</title>
	<meta charset="utf-8">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
	<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="js/validation.min.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen">
	<script type="text/javascript" src="js/script.js"></script>
	<style type="text/css">
			body { background: url(images/bglight2.jpg); }
			.display{
				width: 60em;
				height: auto;
			    margin: 10px auto;
			    margin-top: -2.1em;
			   	left: 18%;
			    position: absolute;
			    border: 1px outset #dddddd;
			    border-radius: 20px;
			    border-style: groove;
			    background-color: #efefef;
			}
			#header{
				height: 100px;
				padding: 10px;
				background-color: #755;
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
				color: #755;
			}
			#login_div hr{
				height: 5px;
				background-color: #755;
				border-radius: 10px;
			}
			input[type='text'],input[type='password']{
				border-radius: 50px;
				
				border-style: groove;
				border: 1px solid #755;
			}
			button#btn-login{
				border-radius: 50px;
				background: #755;
				border: 0;
			}
			button#btn-login:hover{
				background: #977;
			}
			#login_div hr#under{
				height: 2px;
				background-color: #755;
				border-radius: 10px;
				margin: 2px;
			}
			.table {
 				 width: 70%;
    			}
    		.table input[type="text"] {
			    font-size: 12px;
			    height: 28px;
			    padding: 7px 9px;
			    width: 200px;
}
			.table label{
				font-size: 14px;
			}
    		.table select {
			    font-size: 12px;
			    height: 30px;
			    padding: 7px 9px;
			    width: 200px;
}
			.cancel,
			.btn-successs{
				width: 100px;
				height: 30px;
				clear: both;
				//color: #000;
				background-color: #755;
				border-top-right-radius: 10px;
				border-top-left-radius: 10px;
				border-bottom-left-radius: 10px;
				border-bottom-right-radius: 10px;
				font-family: georgia;
			}
			.btn-successs:hover{
				color: #fff;
			;
}				
	</style>
</head>
<body>
	<div class="container-fluid text-center">    
  		<div class="row">
	    	<div class="jumbotron" id="header"> 
	      		<h1>Employee Edit Profile</h1>

	      	</div>
      	</div>
      	<div class="display ">
      			<div class="container">
      			<!--<div class="errors text-left">
				<?php 
					foreach ($error_message as $error) {
						echo "<li>".$error."</li>";
					}
				 ?>
			</div>-->
      		<form action="" method="post">
			<table class="table">
				<tr>
				<td>
					<label for="title"><b>Title: </b></label>
				</td>
				<td>	
					<select name="title" >
						<option >...Select title...</option>
						<option value="Mr." selected>Mr.</option>
						<option value="Mrs.">Mrs.</option>
						<option value="Mallam">Mallam.</option>
						<option value="Mallama">Mallama.</option>
						<option value="Chief">Chief.</option>
						<option value="Dr.">Dr.</option>
						<option value="Prof.">Prof.</option>
						<option value="Hon.">Hon.</option>
					</select>
				</td>
			</tr>
				<tr>
				<td>
					<label for="first name"><b>First Name: </b></label>
				</td>
				<td>	
					<input type="text" name="fname" 
					<?php 
							 if (isset($_POST['fname'])){
							 		echo "value='$_POST[fname]'";
							 }
						?>
						/>
				</td>
			</tr> 
			<tr>
				<td>
					<label for="last name"><b>Last Name: </b></label>
					
				</td>
				<td>	
					<input type="text" name="lname" 
					<?php 
							 if (isset($_POST['lname'])){
							 		echo "value='$_POST[lname]'";
							 }
						?>
						/>
				</td>
			</tr> 
			<tr>
				<td>
					<label for="other_Name"><b>Other name: </b></label>
				</td>
				<td>	
					<input type="text" name="oname" 
					<?php 
							 if (isset($_POST['oname'])){
							 		echo "value='$_POST[oname]'";
							 }
						?>
						/>
				</td>
			</tr>
			<tr>
				<td>
					<label><b>Qualification:</b></label>
				</td>
				<td>
					<select name="qualification">
						<option>....select....</option>
						<option value="Bsc">Bsc</option>
						<option value="HND">HND</option>
						<option value="Diploma">Diploma</option>
						<option value="Master">Master Degree</option>
						<option value="Doctorate">Doctorate</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label><b>Date of Birth:</b></label>
				</td>
				<td>
					<input type ="date" name="dob" id="dob" style="color:#999; "value="eg 1990-01-01" onfocus="this.value==this.defaultValue? this.value='':null"
					<?php 
							 if (isset($_POST['dob'])){
							 		echo "value='$_POST[dob]'";
							 }
						?>
						/>
				</td>
			</tr>
			<tr>
				<td>
					<label><b>State of Origin:</b></label>
				</td>
				<td>
					<select name="state">
						<option>....Select....</option>
						<?php 
						//$state=mysql_query("select* from state");
							while ($state=mysql_fetch_array($db_state)) {
								echo '<option selected value="'.$state['stateid'].'">'.$state['statename'].'</option>';
							}


						 ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label for="phoneNo_"><b>Phone No_: </b></label>
				</td>
				<td>	
					<input type="text" name="phoneNo_" 
					<?php 
							 if (isset($_POST['phoneNo_'])){
							 		echo "value='$_POST[phoneNo_]'";
							 }
						?>
						/>
				</td>
			</tr> 
			<tr>
				<td>
					<label for="email"><b>Email Address: </b></label>
				</td>
				<td>	
					<input type="text" name="email" 
					<?php 
							 if (isset($_POST['email'])){
							 		echo "value='$_POST[email]'";
							 }
						?>
						/>
				</td>
			</tr> 
			<tr>
				<td>
					<label for="pwd"><b>Password: </b></label>
				</td>
				<td>	
					<input type="password" name="pwd" 
					<?php 
							 if (isset($_POST['pwd'])){
							 		echo "value='$_POST[pwd]'";
							 }
						?>
						/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="cpwd"><b> Confirm Password: </b></label>
				</td>
				<td>	
					<input type="password" name="cpwd" 
					<?php 
							 if (isset($_POST['cpwd'])){
							 		echo "value='$_POST[cpwd]'";
							 }
						?>
						/>
				</td>
			</tr> 
			<tr>
				<td>
					<label for="gender"><b>Gender:</b></label>
				</td>
				<td>
				<select name="gender"> 
					<option>...Gender...</option>
					<option value="male" selected>male</option>
					<option value="female">Female</option>		
				</select>
				</td>
			</tr>
						<tr>
				<td>
					<label><b>Marital Status:</b></label>
				</td>
				<td>
					<select name="mstatus">
						<option>...select..</option>
						<option value="married">married</option>
						<option value="single" selected>single</option>
						<option value="divorced">divorced</option>
						<option value="widowed">widowed</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn-successs" name="submit" value="Save">&nbsp;&nbsp;<input type="button" class="btn-successs" name="cancel" value="Cancel" target="login.html"></td>
				
			</tr>
					</table>
				</form>
			</div>	
    	</div>
    </div>	
</body>
</html>
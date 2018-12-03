<?php

$connect=mysqli_connect("localhost","root","","ga");
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
//fetch list of employees
$emps= mysqli_query($connect,'select * from employee') or die('Cannot Find Employeee' . mysqli_error($conn));
  $empsno =mysqli_num_rows($emps);

// define variables and set to empty values
	  $fname_error = $oname_error = $lname_error = $gender_error= $pwd_error= "";
	  $title = $fname = $lname = $oname = $gender  = $pwd = $email="";
	  $error_message = array();
	  
if (isset($_POST['cancel'])) {
	header("Location:login.html");
}

	if(isset($_POST['submit']))
	{
     
      $empId = mysqli_real_escape_string($connect,$_POST['empId']);

    if (empty($_POST["fname"])) {
      $fname_error = "First Name is required";
  }elseif (preg_match("/[A-Za-z]+/", $_POST["fname"]) == FALSE) {
      $fname_error = "Invalid First Name entered";
    } else {
      $fname = mysqli_real_escape_string($connect,ucfirst($_POST['fname']));

    }
  

    

  
    if (empty($_POST["pwd"])) {
     	$pwd_error = "Enter password";
    } elseif($_POST["pwd"] != $_POST["cpwd"]) {
     	$pwd_error = "Password not matched";
	}else {
      $pwd = md5(mysqli_real_escape_string($connect,$_POST['pwd']));
    }

     $level = mysqli_real_escape_string($connect,$_POST['level']);
     $class = substr($level, 0,3);


 	  $gender = mysqli_real_escape_string($connect,$_POST['gender']);

 	$errors = array($fname_error, $lname_error,$oname_error,$gender_error, $pwd_error);
    $errors = array_filter($errors);
	
	if (empty($errors)) {
		$sql = "insert into employee(student_id,password, fname,gender,score,level,class) values('$empId','$pwd','$fname',  '$gender', '','$level','$class');";
		//$sql .= "insert into users(email,password) values('$email', '$pwd')";
 		$add_emp = mysqli_multi_query($connect, $sql);
		if($add_emp)
		{
			header("location:login.html");
		}else(die("Failed to register: ".mysqli_error($connect)));
	}
	else{
		foreach ($errors as $error) {
			$error_message[sizeof($error_message)] = $error;
		}
	}
}
	
 	
	$db_state=mysqli_query($connect, "select * from states order by state_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>0nline  Test</title>
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
				background-color: black;
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
  		<div class="row ">
	    	<div class="jumbotron" id="header"> 
	      		<h1>Welcome to Student Registration Page</h1>

	      	</div>
      	</div>
      	<div class="display ">
      			<div class="container">
      			<div class="errors text-left">
				<?php 
					foreach ($error_message as $error) {
						echo "<li>".$error."</li>";
					}
				 ?>
			</div>
      		<form action="" method="post">
			<table class="table">
			<?php 
						$empsno++;
						$xxx=sprintf("%03d",$empsno);
						//var_dump($xxx);
					 ?>
			
				<tr>
				<td>
					<label><b>Level:</b></label>
				</td>
				<td>
					<select name="level" onchange="select_level_ajax(this.value)">
						<option value="">--Select Level---</option>
						<?php 
							$i=3;
							for ($i=3; $i <= 3; $i++) { 
								# code...
								?>
							<option value="SS<?php echo $i; ?>SCI">SS<?php echo "$i"; ?>Science</option>
							<option value="SS<?php echo $i; ?>ART">SS<?php echo "$i"; ?>Art</option>
						<?php 
							}

						 ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<label for="empId"><b>Student ID: </b></label>
				</td>
				<td id="empId" name='empId'>	
					<input type="text" id="empId" name="empId"  
					<?php 
							 if (isset($_POST['empId'])){
							 		echo "value='$_POST[empId]'";
							 }
						?>
						/>
				</td>
			</tr>
			
				 
				<tr>
				<td>
					<label for="first name"><b>Full Name: </b></label>
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
					<label for="gender"><b>Gender:</b></label>
				</td>
				<td>
				<select name="gender"> 
					<option>--Select Gender--</option>
					<option value="male" >male</option>
					<option value="female">Female</option>		
				</select>
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
				<td></td>
				<td><input type="submit" class="btn-successs" name="submit" value="Register">&nbsp;&nbsp;
				<input type="submit" class="btn-successs" name="cancel" value="Cancel">
				</td>
				
			</tr>
					</table>
				</form>
			</div>	
    	</div>
   
    </div>	
</body>
</html>
<script type="text/javascript">
  function select_level_ajax(stid){
        //alert(stid);exit;
       console.log(stid);
        $.ajax({

            url: 'ajax_level_id.php',
            data: 'stid='+stid,
            success:function(res){
                //alert(res);exit;
               $("#empId").html(res);
            }
        });
    }
    
 function select_sec_ajax(stid){
        //alert(stid);exit;
       console.log(stid);
        $.ajax({

            url: 'ajax_level_id.php',
            data: 'stid='+stid,
            success:function(res){
                //alert(res);exit;
               $("#empId").html(res);
            }
        });
    }
    

</script>

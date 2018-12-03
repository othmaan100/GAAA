<?php
	session_start();
	require_once 'dbconfig.php';

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		$user_email = trim($_POST['uemail']);
		$user_password = trim($_POST['pwd']);
		
		$password = md5($user_password);
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM employee WHERE student_id=:email");
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['password']==$password){
				
				//$backURL = empty($_SESSION['backURL']) ? '/' : $_SESSION['backURL'];
				//unset($_SESSION['backURL']);
				//header('Location: ' . $backURL);
				echo "ok"; // log in
				$_SESSION['user_session'] = $row['id'];
				$_SESSION['user_email'] = $row['student_id'];
			}
			else{
				
				echo "Stuent Id or password does not exist."; // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>
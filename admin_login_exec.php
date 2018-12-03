<?php
	session_start();
	require_once 'dbconfig.php';

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		$user = trim($_POST['username']);
		$user_password = trim($_POST['pwd']);
		
		$password = md5($user_password);
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM tbl_admin WHERE username=:user");
			$stmt->execute(array(":user"=>$user));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['password']==$password){
				
				//$backURL = empty($_SESSION['backURL']) ? '/' : $_SESSION['backURL'];
				//unset($_SESSION['backURL']);
				//header('Location: ' . $backURL);
				echo "ok"; // log in
				$_SESSION['admin_session'] = $row['aid'];
				$_SESSION['username'] = $row['username'];
			}
			else{
				
				echo "email or password does not exist."; // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>
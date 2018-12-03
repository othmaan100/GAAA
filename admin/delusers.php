<?php
require_once '../dbconfig.php';
	//query
	session_start();
	if(isset($_GET['id'])){
		$_SESSION['id']=$_GET['id'];
	}
	
if (isset($_SESSION['id'])){

	$id_to_del = $_SESSION['id'];

	
$sql="DELETE FROM employee WHERE id='$id_to_del' ";
if($db_con->exec($sql)){
    header('location: manage_users.php');
}

	
}



?>
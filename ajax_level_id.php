<?php 
$conn=mysqli_connect("localhost","root","","GA");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_REQUEST['stid']!=''){

	 $level=$_REQUEST['stid'];
	 //echo "$level";
	//echo $_REQUEST['stid'];
	 //exit;
    $qry="SELECT * FROM employee WHERE level ='".$_REQUEST['stid']."'";
		$sqllgas = mysqli_query($conn,$qry);

		
				
		$total_num= mysqli_num_rows($sqllgas);

		$total_num++;
		$total_num=sprintf("%03d",$total_num);

		if($total_num>0){ 
?>
				<input type="text" id="empId" name="empId"  value="<?php echo 'GA/'.$_REQUEST['stid'].'/'.$total_num ?>" />

			

		<?php
		}
		}
		

?>
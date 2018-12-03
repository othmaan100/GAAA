<?php
session_start();

require_once '../dbconfig.php';
if(isset($_POST['add'])){      
		$quesNo=$_POST['quesNo'];
		$ques=$_POST['ques'];
		$ans=array();
		$ans[1]=$_POST['ans1'];
		$ans[2]=$_POST['ans2'];
		$ans[3]=$_POST['ans3'];
		$ans[4]=$_POST['ans4'];
		$rightAns=	$_POST['rightAns'];

var_dump($_SESSION['level']);
		$level=$_SESSION['level'];

	
		$qry1="insert into questions(quesNo,ques,level) values('$quesNo','$ques','$level')";
		if($db_con->exec($qry1) === false){
				$msg = 'Error inserting the Question.';
				die('Error...');
			}else{
				
			foreach ($ans as $key=>$ansName){
				if($ansName !=''){
					if($rightAns==$key){
						$rightqry="insert into answers(quesNo,right_ans, ans) values('$quesNo','1', '$ansName')";

					}else{
						$rightqry="insert into answers(quesNo,right_ans, ans) values('$quesNo','0', '$ansName')";

					}
					 if($db_con->exec($rightqry) === false){
						die('Error...');
						$msg=0;
						 
					 }else{
						 $msg=1;
						
						
						header('location:add_quest.php?msg=1');
						
					}
				}
			}
			
			
		}
		
	
	

	
		}



		
?>
<?php
require_once '../dbconfig.php';
if(isset($_POST['update'])){      
		$quesNo=$_POST['quesNo'];
		$ques=$_POST['ques'];
                $quesId=$_POST['quesId'];
                 $ans=$_POST['ans'];
               // var_dump($ans);
                $ansid=$_POST['ansid'];
                //var_dump($ansid);
               
                for($i=0; $i<4; $i++){
                  $updopts="update answers set ans='$ans[$i]' where ans_id='$ansid[$i]'";
                    $optAdd= $db_con->exec($updopts);
                        if(isset($_POST['rightAns'])){
                            $right =($_POST['rightAns'] -1);
                            
                            $updwrngans="update answers set right_ans='0' where ans_id='$ansid[$i]'";
                            $optrightAdd= $db_con->exec($updwrngans);
                            $updrightans="update answers set right_ans='1' where ans_id='$ansid[$right]'";
                            $optrightAdd= $db_con->exec($updrightans);
                }
                }
                
                
                $updqst="update questions set ques='$ques' where q_id='$quesId'";
		$updtqustn=$db_con->exec($updqst);
                    header('location:quest_list.php');
}

                

		
?>
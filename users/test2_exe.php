<?php 
session_start();
        include_once '../dbconfig.php'; 
   if(isset($_SESSION['user_session'])){
      $id=$_SESSION['user_session'];
   }
        $qr = $db_con->prepare("SELECT * FROM questions LIMIT 10 ");
$qr->execute();

$count = $qr->rowCount();

      //  var_dump($_POST);
         if(isset($_POST['datas'])){
            $strans=$_POST['datas'];
            $ansx = explode(",", $strans);
           // var_dump($ansx);
            
            if (!isset($_SESSION['score'])){
            $_SESSION['score'] = '0';
            }
            
    $sqlans= "SELECT * FROM answers where  right_ans='1'";	
foreach ($db_con->query($sqlans) as $rowsans) {
    foreach ($ansx as $chk){
        if($chk==$rowsans['ans_id']){
                $_SESSION['score']++;
        }
        }
}

if (isset($_SESSION['score'])) {
    $score=($_SESSION['score']/$count*10);
    $score=round($score,2);
    $adscr = $db_con->prepare("update employee set score='$score', status='1' where id='$id' ");
     $adscr->execute();
    echo '<div class="col-md-5"><pre>Congrats I You have Just completed the test.<br/>
       Your Test Score is:'. $score.'</pre></div.';
    unset($_SESSION['score']);
         }
        //  header('location:final.php');
// header('location:test2_exe.php');
        exit();
         }
    
                ?>
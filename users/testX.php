 <?php
session_start();


//if (isset($_GET['q'])) {
//$number = (int)$_GET['q'];
//}else{
//header('Location: index.php');
//}
if(!isset($_SESSION['user_session']))
{
  //$_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
	header("Location: ../login.html");
}

include_once '../dbconfig.php';

$empid=$_SESSION['user_session'];



$stmt = $db_con->prepare("SELECT * FROM employee WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

$qr = $db_con->prepare("SELECT * FROM questions LIMIT 10  ");
$qr->execute();

$count = $qr->rowCount();
$qrow=$qr->fetch(PDO::FETCH_ASSOC);

$qst = $db_con->prepare("SELECT * FROM questions LIMIT 10  ");
$qst->execute();
$qstrow=$qst->fetch(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>0nline Promotion Examination Test</title>
 

  <link href="bootstrap.min.css" rel="stylesheet" media="screen">
 
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  
<script type="text/javascript" src="bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="scriptz.js"></script>

<link href="sb-admin.css" rel="stylesheet">



<style type="text/css">
 
      #header{
        height: 50px;
        padding: 10px;
        background-color: #755;
        border-bottom: 2px inset #aaaaaa;
        border-bottom-style: groove;
        color: #eee;
      }
      #header nav{
        background: black;
      }
      #navbar a{
        color: #eee;
      }
       #navbar ul.dropdown-menu li a{
        color: #000;
      }

.class{
    position: relative;
    width: 100%;
}
.caption {
    position: absolute;
    background-color: transparent;
    bottom: 0;
    top: 34%;
    z-index: 5;
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
.main.col-md-offset-4 {
	min-height: 500px;
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
color: black;
font-size: 400%;
font-weight: 400;
line-height: 1.25;
margin: 0;
text-shadow: 0 1px 1px rgba(0, 0, 0, 0.4);
}
.caption p{
    color: black;
    font-size: 1em;
}
#blue-band-holder p {
color: white;
font-size: 22px;
text-align: center;
margin: 0;
}
.site-full-width{
    background: black;
    height: 4em;
    margin-top:5px;
    }
      #qustn {
    border: 1px solid #ddd;
    padding: 0 1.4em 1.4em 1.4em;
    margin: 0 0 1.5em 0;
}

.xy {
  
  font-size: xx-large;
  color: white;
}
.yx {
  
  font-size: x-large;

}

span .xy{
  font-size: 10px;
}
.answered{
  color: red;
}
  </style>


</head>

<body class="fixed-nav sticky-footer " id="page-top">


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><div id="hms">00:05:00</div></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">



      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

<li class="nav-item" data-toggle="tooltip" data-placement="right" title="QuestionStatus">
      	<div >
               
      <?php 

        
          $sql= "SELECT * FROM questions inner join employee on questions.level=employee.class WHERE employee.id='$empid' order by rand() LIMIT 10 ";
            $_SESSION['questions'] = array();
            $i=0;
            foreach ($db_con->query($sql) as $rows) {
              
      ++$i;
          $_SESSION['questions'][$i]=0;
    //  echo "<span  class='border xy ' id='s". $i ."' ><i class='fa fa-check'>". $i ."</i></span> ";
       echo "<a href='#". $i ."'><span   class='border xy ' id='s". $i ."' >". $i ."</span> </a> ";
      }
      //var_dump($_SESSION['questions']);
       ?>
      </div>
      </li>

       
            
          </ul>
        </li>
      </ul>



    <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        
        <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $row['fname']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>

      </ul>
    </div>
  </nav>


<div class="content-wrapper">
    <div class="container-fluid">   
            <div class="item active">

<?php 
				if($_SERVER['REQUEST_METHOD'] == 'POST'){    
                                    
                $qrs = $db_con->prepare("SELECT * FROM questions ");
               $qrs->execute();
                $counts = $qrs->rowCount();
               $ans= array();
                      for($i=1; $i<=$counts; $i++){
                          if(isset($_POST[$i])) {
                              $ans[$i] = $_POST[$i];
                          }else{
                              $ans[$i] = 0;
                          }	
	
                      } 
                          //  var_dump($ans);
			if (!isset($_SESSION['score'])){
			$_SESSION['score'] = '0';
			}
           

           

            $sqlans= "SELECT * FROM answers where  right_ans='1'";	
	foreach ($db_con->query($sqlans) as $rowsans) {
            foreach ($ans as $chk){
		if($chk==$rowsans['ans_id']){
                        $_SESSION['score']++;
		}
		
		
			
		}
                
		
	}
      
        $score=($_SESSION['score']/$count*10);
        $score=round($score,2);
        $id=(int)$_SESSION['user_session'];
	$adscr = $db_con->prepare("update employee set score='$score', status='1' where id='$id' ");
        $adscr->execute();
        echo "<script> window.open('final.php', '_self'); </script>";
        //header('location:final.php');
		exit();
				}
                                
			?>
                     <div class="containerx" style="height:530px;">
				<div class="image" style="width:100%">
                                   
        
					 <div class="col-md-offset-1">
					 
                                             
                                             
                         <div class="test" id="test">
                            <form method="post" name="quiz" id="quiz_form" action="">
                    <input type="hidden" value="<?php echo $count ?>" id="qcount" name="qcount"/>
               <!--     <input type="hidden" value="<?php //echo '72,82,84,67,77'; ?>" id="qcount" name="ans"/> -->

      
                    <table class=" table-responsive table-hover table-striped">
<h6 style="text-align: center; font-family:san-serif; font-size: 30px; text-shadow:-4px 4px 2px #666; letter-spacing:4px; ">Answer all the following Questions</h6>

            <?php
	
      	$sql= "SELECT * FROM questions inner join employee on questions.level=employee.class WHERE employee.id='$empid' order by rand() ";
      			
			$i=0;
			foreach ($db_con->query($sql) as $rows) {
				++$i;

              ?>
                                          
	<tr>	
                           
    <td coLspan=”2”>
		<h3 id="<?php echo $i ?>">Question <?php $qnum=$rows['quesNo'];  echo $i ?>: <label  for="<?php echo $i ?>"> <?php echo $rows['ques']; ?> </label></h3>									</td>
	</tr>
	<?php 						
	$sqla= "SELECT * FROM answers where quesNo='$qnum'order by rand()";							
		foreach ($db_con->query($sqla) as $rowsa) {						 ?>
	<tr>
		<td>
     <input type="radio" name="<?php echo  $i ?>"  d="<?php echo  $i ?>"  id="<?php echo  $i ?>" class="rchk"   value="<?php  echo $rowsa['ans_id']; ?>"/> <?php  echo $rowsa['ans']; ?>
		</td>
	
          


    <?php }

    } 
    ?>
                        
                 
		<tr>
                    <td >
                        <br/>
                        <input class="btn btn-success" type="submit" id="btn_next" onclick="return confirm('Are you Sure to Submit?')" name="submit" value="Final Submit"/>
				<input type="hidden" name="number" value="<?php  //echo $number ?>"/>
                               
                    </td>
		</tr>
											
	</table>
	</form>

     </div>   
	
                              


        <div id="result"></div>
                                             
        </p>
                          </div>
                                  
                                </div>
                     </div>
                
            </div>
    <footer class="sticky-footer">
      <div class="container">
     
          <div class="site-full-width darkbluecolor">
          
         <div id="blue-band-holder">
            <p>Online  Examination Software</p>
       </div>

    </div>
                 
    </div>
    </div>
    </footer>
<script src="jquery.min.js"></script>
 <script src="bootstrap.bundle.min.js"></script>
    <script src="bootstrap.min.js"></script>
<script src="js/sb-admin.min.js"></script>

<script src="sb-admin.min.js"></script>

</div>
</body>
</html>

    <script>


function  anstatus(){

}



function  anstatus(){
var counter = $('#qcount').val();
j=1;
while (j<=counter){
    if( $("input[name='"+j+"']:checked")){
      // $(this).css("color", "red");
     $('#s'+j+'').css("color", "red");
    // document.getElementById(''+j+'').innerHTML="Answered";
 }else {
      $('#s'+j+'').css("color", "blue");
 }

 j++;
}
}

function  Xanstatus(){

   var counter = $('#qcount').val();
  for(j=1; j<=counter; j++){


 if( $("input[name='"+j+"']:checked")){
  
     $('#s'+j+'').css("color", "red");
    // document.getElementById(''+j+'').innerHTML="Answered";
 }else if( $(!"input[name='"+j+"']:checked")){
      $('#s'+j+'').css("color", "blue");
 }
  }
  }



$(document).ready(function(){
   
    


     




    function astatus(){
     var counter = $('#qcount').val();
    for(j=1; j<=counter; j++){
   if( $("input[name='"+j+"']:checked")){
       document.getElementById(''+j+'').innerHTML="Answered";
   }else{
        document.getElementById(''+j+'').innerHTML="Not Answered";
   }
    }
    }
   
	function count(){
            var startTime = document.getElementById('hms').innerHTML;
            var pieces= startTime.split(":");
            
            var time = new Date();
            time.setHours(pieces[0]);
            time.setMinutes(pieces[1]);
            time.setSeconds(pieces[2]);
            
            var timedif = new Date(time.valueOf() - 1000);
            var newTime=timedif.toTimeString().split(" ")[0];    
            document.getElementById('hms').innerHTML=newTime;
           if(newTime==="00:00:00"){
                clearTimeout(time_out);
                $('#btn_next').css('display',' none');
                alert("Sorry Your time is over");
              
                autosubmit();
                //esubmit()
                
            }  
            time_out= setTimeout(count,1000);        
        }
        count();	
    }); 
    
    function esubmit(){
         document.getElementById('quiz_form').submit(); 
         
    }
    function autosubmit(){
          var qcount = $('#qcount').val(); 
        var uans = new Array();
        for(i=1; i<=qcount; i++){        
          uans.push($("input[name='"+i+"']:checked").val());      
        }
    ans=uans.toString();
    var datas=ans;
    console.log(datas);
    

$.ajax({
       type: "POST",
       url: "test2_exe.php",
       data: {datas:ans},
       success:function(data){
           alert("Exams Submitted");
           $('#result').html(data);
         $('#test').hide();
          $('#hms').hide();
             // window.open('test2_exe.php','_self');
             // window.open('final.php','_self');
    },
     error: function(){
                alert("Exams not Submitted");
                 }
    });



    };
   
   //check for navigation time API support
if (window.performance) {
  console.info("window.performance work's fine on this browser");
}
  if (performance.navigation.type == 1) {
    console.info( "This page is reloaded" );
    alert('You have been disqualified for refreshing the browser');
    autosubmit();
  } else {
    console.info( "This page is not reloaded");
  }

   /*timer*/
/*
      var seconds = 10;
      function secondPassed() {
          var minutes = Math.round((seconds - 30)/60),
              remainingSeconds = seconds % 60;

          if (remainingSeconds < 10) {
              remainingSeconds = "0" + remainingSeconds;
          }

          document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
          if (seconds == 0) {
              clearInterval(countdownTimer);
              $('#btn_next').css('display',' none');
                alert("Sorry Your time is over");
             //form1 is your form name
            //document.form1.submit();
          } else {
              seconds--;
          }
      }
      var countdownTimer = setInterval('secondPassed()', 1000); */
    
    </script>
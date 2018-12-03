<?php
error_reporting(0);
session_start();
include_once 'connection.php';
$final = false;
if (!isset($_SESSION['user_session'])) {
    $_GLOBALS['message'] = "Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}else if(isset($_REQUEST['logout'])){
    header("Location:logout.php");
}else if (isset($_REQUEST['next']) || isset($_REQUEST['fsum'])) {
    //Process first question
    if (isset($_REQUEST['markreview'])) {
        $_SESSION['q1status'] = 'review';
        $_SESSION['q1stdans'] = $_REQUEST['answer'];
    } else {
        $_SESSION['q1status'] = 'answered';
        $_SESSION['q1stdans'] = $_REQUEST['answer'];
    }

    $_SESSION['curqnid'] = 2;
    if (isset($_REQUEST['fsum'])) {
        $_REQUEST['summary'] = "summary";
    }
} else if (isset($_REQUEST['viewsummary']) || isset($_REQUEST['summary'])) {

    //Process Second question

    if (isset($_REQUEST['markreview'])) {
        $_SESSION['q2status'] = 'review';
        $_SESSION['q2stdans'] = $_REQUEST['answer'];
    } else {
        $_SESSION['q2status'] = 'answered';
        $_SESSION['q2stdans'] = $_REQUEST['answer'];
    }

    $_SESSION['curqnid'] = 0;
} else if (!isset($_SESSION['starttime']) && !isset($_REQUEST['finalsubmit'])) {
    //firsttime entry
    $_SESSION['starttime'] = time();
    $_SESSION['curqnid'] = 1;
    $_SESSION['q1status'] = "unanswered";
    $_SESSION['q1stdans'] = "unanswered";
    $_SESSION['q2status'] = "unanswered";
    $_SESSION['q2stdans'] = "unanswered";
} else if (isset($_REQUEST['change'])) {
    //redirect to testconducter

    $_SESSION['curqnid'] = substr($_REQUEST['change'], 7);

      header('Location: test.php');
} else if (isset($_REQUEST['previous'])) {

    if (isset($_REQUEST['markreview'])) {
        $_SESSION['q2status'] = 'review';
        $_SESSION['q2stdans'] = $_REQUEST['answer'];
    } else {
        $_SESSION['q2status'] = 'answered';
        $_SESSION['q2stdans'] = $_REQUEST['answer'];
    }
    $_SESSION['curqnid'] = 1;
} else if (isset($_REQUEST['summary'])) {
    // nothing to do
} else if (isset($_REQUEST['finalsubmit'])) {
    // nothing to do
} else if (isset($_REQUEST['fs'])) {
    //Final Submission
    header('Location: test.php?finalsubmit=yes');
}
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
        <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
        <script type="text/javascript" src="cdtimer.js" ></script>
        <link rel="stylesheet" type="text/css" href="oes.css"/>
        <meta http-equiv="CACHE-CONTROL" content="NO-CACHE"/>
        <meta http-equiv="PRAGMA" content="NO-CACHE"/>
        <meta name="ROBOTS" content="NONE"/>

        <script type="text/javascript" >
            <!--
<?php
if (!isset($_REQUEST['finalsumbit']) && isset($_SESSION['starttime'])) {
    $elapsed = (time() - $_SESSION['starttime']);

    if (($elapsed / 60) < 2) {
        echo "var hour=00;";
        if ($elapsed == 0)
            $elapsed = 1;
        echo "min=" . (int) (2 - ($elapsed / 60)) . ";";
        if ($elapsed > 60)
            echo "sec=" . (60 - ($elapsed - 60)) . ";";
        else
            echo "sec=" . (60 - $elapsed) . ";";
    }
    else {
        echo "var hour=0;var min=0;sec=01;";
        unset($_SESSION['starttime']);
    }
}
?>

    -->
        </script>

    </head>
    <body >
<?php
if ($_GLOBALS['message']) {
    echo "<div class=\"message\">" . $_GLOBALS['message'] . "</div>";
}
?>
        <div id="container">
            <div id="header"> 
                

            </div>
            <form id="test" action="test.php" method="post">

                <div class="navbar-header menubar" style="width:100%;height:50px; background-color: black;">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="index.php">Online Exam Portal</a>
                        <div id="navbar" class="navbar-collapse collapse">
                                <ul  class="nav navbar-nav navbar-right" id="menu" style="right:70px;">
<?php
if (isset($_SESSION['user_session'])) {
    $email = $_SESSION['user_email'];
    $query = mysql_query("select * from employee where email = '$email'");
    $fullname = "";
    $res=mysql_fetch_array($query);
    $fullname = ucfirst($res['fname'])." ". ucfirst($res['lname']);
    
    //echo "<b><li align: center;>".$fullname."</li></b>";
    // Navigations
    if ($_REQUEST['finalsubmit']) {
?>

                                <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>

<?php
    }
?>
                    </ul>
                </div>
                </div>
                <div class="page">

<?php
    if (isset($_REQUEST['summary']) || isset($_REQUEST['viewsummary'])) {

        $_SESSION['curqnid'] = 0;
        //summary
?>
                    <table border="0" width="100%" class="ntab" >
                        <tr>
                            <th style="width:40%;"><h3><span id="timer" class="timerclass"></span></h3></th>

                        </tr>
                    </table>
                    <table cellpadding="30" cellspacing="10" class="datatable">
                        <tr>
                            <th>Question No</th>
                            <th>Status</th>
                            <th>Change Your Answer</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td <?php if (strcmp($_SESSION['q1status'], "review") == 0 || strcmp($_SESSION['q1status'], "unanswered") == 0) {
            echo "style=\"color:#ff0000;\"";
        } ?> > <?php echo $_SESSION['q1status']; ?></td>
                            <td><?php echo "<input type=\"submit\" value=\"Change 1 \" name=\"change\" class=\"ssubbtn\" />"; ?></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td <?php if (strcmp($_SESSION['q2status'], "review") == 0 || strcmp($_SESSION['q2status'], "unanswered") == 0) {
                        echo "style=\"color:#ff0000;\"";
                    } ?> > <?php echo $_SESSION['q2status']; ?></td>
                            <td><?php echo "<input type=\"submit\" value=\"Change 2 \" name=\"change\" class=\"ssubbtn\" />"; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;"><input type="submit" name="finalsubmit" value="Final Submit" class="subbtn"/></td>
                        </tr>
                    </table>
<?php
                } else if (isset($_REQUEST['finalsubmit'])) {
?>
                    <table cellpadding="20" cellspacing="30" border="0" style="background:#ffffff url(images/page.gif);text-align:left;line-height:20px;">
                        <tbody>
                        <tr>
                            <td colspan="2"><h3 style="color:#0000cc;text-align:center;">Test Summary</h3></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#ff0000;border-width:4px;"/></td>
                        </tr>
                        <tr>
                            <td>Applicant</td>
                            <td><?php echo $fullname; ?></td>
                            &nbsp;
                            &nbsp;
                        </tr>
                        <tr>
                            <td>Test Duration</td>
                            <td>00:02:00</td>
                            &nbsp;
                            &nbsp;
                        </tr>
                        <tr>
                            <td>Max. Marks</td>
                            <td>2</td>
                            &nbsp;
                            &nbsp;
                        </tr>
                        <tr>
                            <td>Obtained Marks</td>
                            <td><?php
                    $marks = 0;
                    if (strcmp($_SESSION['q1stdans'], "Muhammadu Buhari") == 0)
                        $marks = $marks + 1;
                    if (strcmp($_SESSION['q2stdans'], "DennisRitchie") == 0)
                        $marks = $marks + 1;
                    echo $marks;
?></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><?php echo (($marks / 2) * 100) . " %"; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#ff0000;border-width:2px;"/></td>
                        </tr>
                        <tr>
                            <td colspan="2"><h3 style="color:#0000cc;text-align:center;">Test Information in Detail</h3></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#ff0000;border-width:4px;"/></td>
                        </tr>
                        </tbody>
                    </table>
                    <table cellpadding="30" cellspacing="10" class="datatable">
                        <!--<tr>
                            <th>Q. No</th>
                            <th>Question</th>
                            <th>Correct Answer</th>
                            <th>Your Answer</th>
                            <th>Score</th>
                            <th>&nbsp;</th>
                        </tr>-->
                       <!-- <tr>
                            <td>1</td>
                            <td>Who won Nigeria general elections in 2015?</td>
                            <td>Muhammadu Buhari</td>
                            <td><?php echo $_SESSION['q1stdans']; ?></td>
<?php
                    if (strcmp($_SESSION['q1stdans'], "Muhammadu Buhari") == 0) {
                        echo "<td>1</td><td class=\"tddata\"><img src=\"images/correct.png\" title=\"Correct Answer\" height=\"30\" width=\"40\" alt=\"Correct Answer\" /></td>";
                    } else {
                        echo "<td>0</td><td class=\"tddata\"><img src=\"images/wrong.png\" title=\"Wrong Answer\" height=\"30\" width=\"40\" alt=\"Wrong Answer\" /></td>";
                    }
?>


                        </tr>-->
                       <!-- <tr>
                            <td>2</td>
                            <td>Who is the creator of "C Programming Language"?</td>
                            <td>Dennis Ritchie</td>
                            <td><?php echo $_SESSION['q2stdans']; ?></td>
<?php
                    if (strcmp($_SESSION['q2stdans'], "DennisRitchie") == 0) {
                        echo "<td>1</td><td class=\"tddata\"><img src=\"images/correct.png\" title=\"Correct Answer\" height=\"30\" width=\"40\" alt=\"Correct Answer\" /></td>";
                    } else {
                        echo "<td>0</td><td class=\"tddata\"><img src=\"images/wrong.png\" title=\"Wrong Answer\" height=\"30\" width=\"40\" alt=\"Wrong Answer\" /></td>";
                    } ?>


                        </tr>-->
                            <?php
                            unset($_SESSION['starttime']);
                            unset($_SESSION['curqnid']);
                            unset($_SESSION['q1status']);
                            unset($_SESSION['q1stdans']);
                            unset($_SESSION['q2status']);
                            unset($_SESSION['q2stdans']);
                            ?>
                    </table>
<?php
                        }if ($_SESSION['curqnid'] == 2) {
?>
                    <div class="tc">

                        <table border="0" width="100%" class="ntab">
                            <tr>
                                <th style="width:40%;"><h3><span id="timer" class="timerclass"></span></h3></th>
                                <th style="width:40%;"><h4 style="color: #af0a36;">Question No: 2 </h4></th>
                                <th style="width:20%;"><h4 style="color: #af0a36;"><input type="checkbox" name="markreview" value="mark"> Mark for Review</input></h4></th>
                            </tr>
                        </table>
                        <textarea cols="100" rows="8" name="question" readonly style="width:96.8%;text-align:left;margin-left:2%;margin-top:2px;font-size:120%;font-weight:bold;margin-bottom:0;color:#0000ff;padding:2px 2px 2px 2px;">Who is the creator of "C Programming Language"?</textarea>
                        <table border="0" width="100%" class="ntab">
                            <tr><td>&nbsp;</td></tr>
                            <tr><td >1. &nbsp;<input type="radio" name="answer" value="DennisRitchie" <?php if ((strcmp($_SESSION['q2status'], "review") == 0 || strcmp($_SESSION['q2status'], "answered") == 0) && strcmp($_SESSION['q2stdans'], "DennisRitchie") == 0) {
                                echo "checked";
                            } ?>> Dennis Ritchie</input></td></tr>
                                <tr><td >2. &nbsp;<input type="radio" name="answer" value="Bjarne" <?php if ((strcmp($_SESSION['q2status'], "review") == 0 || strcmp($_SESSION['q2status'], "answered") == 0) && strcmp($_SESSION['q2stdans'], "Bjarne") == 0) {
                                echo "checked";
                            } ?>> Bjarne Stroustrup</input></td></tr>
                                    <tr><td >3. &nbsp;<input type="radio" name="answer" value="JamesGosling" <?php if ((strcmp($_SESSION['q2status'], "review") == 0 || strcmp($_SESSION['q2status'], "answered") == 0) && strcmp($_SESSION['q2stdans'], "JamesGosling") == 0) {
                                echo "checked";
                            } ?>> James Gosling</input></td></tr>
                                    <tr><td >4. &nbsp;<input type="radio" name="answer" value="KenThompson" <?php if ((strcmp($_SESSION['q2status'], "review") == 0 || strcmp($_SESSION['q2status'], "answered") == 0) && strcmp($_SESSION['q2stdans'], "KenThompson") == 0) {
                                echo "checked";
                            } ?>> Ken Thompson</input></td></tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr>
                                        <th style="width:80%;"><b><h4><input type="submit" name="viewsummary" value="View Summary" class="subbtn"/></h4></b></th>
                                        <th style="width:12%;text-align:right;"><b><h4><input type="submit" name="previous" value="Previous" class="subbtn"/></h4></b></th>
                                        <th style="width:8%;text-align:right;"><b><h4><input type="submit" name="summary" value="Summary" class="subbtn" /></h4></b></th>
                                    </tr>

                                </table>
                            </div>
<?php
                        } else if ($_SESSION['curqnid'] == 1) {
?>
                            <div class="tc">

                                <table border="0" width="100%" class="ntab">
                                    <tr>
                                        <th style="width:40%;"><h3><span id="timer" class="timerclass"></span></h3></th>
                                        <th style="width:40%;"><h4 style="color: #af0a36;">Question No: 1 </h4></th>
                                        <th style="width:20%;"><h4 style="color: #af0a36;"><input type="checkbox" name="markreview" value="mark"> Mark for Review</input></h4></th>
                                    </tr>
                                </table>
                                <textarea cols="100" rows="8" name="question" readonly style="width:96.8%;text-align:left;margin-left:2%;margin-top:2px;font-size:120%;font-weight:bold;margin-bottom:0;color:#0000ff;padding:2px 2px 2px 2px;">Who won Nigeria general elections in 2015?</textarea>
                                <table border="0" width="100%" class="ntab">
                                    <tr><td>&nbsp;</td></tr>
                                    <tr><td >1. &nbsp;<input type="radio" name="answer" value="Muhammadu Buhari" <?php if ((strcmp($_SESSION['q1status'], "review") == 0 || strcmp($_SESSION['q1status'], "answered") == 0) && strcmp($_SESSION['q1stdans'], "Muhammadu Buhari") == 0) {
                                echo "checked";
                            } ?>> Muhammadu Buhari</input></td></tr>
                                    <tr><td >2. &nbsp;<input type="radio" name="answer" value="Ebele Jonathan" <?php if ((strcmp($_SESSION['q1status'], "review") == 0 || strcmp($_SESSION['q1status'], "answered") == 0) && strcmp($_SESSION['q1stdans'], "Ebele Jonathan") == 0) {
                                echo "checked";
                            } ?>> Ebele Jonathan</input></td></tr>
                                    <tr><td >3. &nbsp;<input type="radio" name="answer" value="Gen. Tukur Burutai" <?php if ((strcmp($_SESSION['q1status'], "review") == 0 || strcmp($_SESSION['q1status'], "answered") == 0) && strcmp($_SESSION['q1stdans'], "Gen Tukur Burutai") == 0) {
                                echo "checked";
                            } ?>>Gen. Tukur Burutai</input></td></tr>
                                    <tr><td >4. &nbsp;<input type="radio" name="answer" value="Abdul Salam" <?php if ((strcmp($_SESSION['q1status'], "review") == 0 || strcmp($_SESSION['q1status'], "answered") == 0) && strcmp($_SESSION['q1stdans'], "Abdul Salam") == 0) {
                                echo "checked";
                            } ?>> Abdul Salam</input></td></tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr>
                                        <th style="width:80%;"><b><h4><input type="submit" name="next" value="Next" class="subbtn"/></h4></b></th>
                                        <th style="width:8%;text-align:right;"><b><h4><input type="submit" name="fsum" value="Summary" class="subbtn" /></h4></b></th>
                                    </tr>

                                </table>


                            </div>
<?php
                        }
                        closedb();
                    }
?>
                </div>

            </form>
            <div id="footer">
            </div>
        </div>
    </body>
</html>
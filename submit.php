<?php
//DATABASE CONNECTION & SESSION CHECK:
include('includefiles/sess.php');
include('../includefiles/conn_db.php');
//$StudentSysIdVar = $_SESSION['id'];
$StudentSysIdVar=$_POST["StudentSysId"];
$QuIdQur = "SELECT q_id FROM questions WHERE exam_id = (SELECT exam_id FROM exams WHERE exam_status = 1)";
$QuIdQurRun = mysqli_query($conn, $QuIdQur);
while($row=mysqli_fetch_array($QuIdQurRun))
{

if (empty($_POST[$row['q_id']])) { $op_selected = '0'; } else $op_selected = $_POST[$row['q_id']];
mysqli_query($conn, "INSERT INTO answers (student_sys_id, q_id, op_selected) VALUES('$StudentSysIdVar',".$row['q_id'].",'".$op_selected."')") or die ('<font color=red><b>SYSTEM ERROR YOUR ANSWERS DID NOT SUBMITED SUCCESSFULY, INFORM THE EXAM ADMINISTRATOR.</b></font>');
}
mysqli_query($conn, "UPDATE sessions SET session_end_date = CURDATE(), session_end_time = CURTIME() WHERE student_sys_id = '$StudentSysIdVar' AND exam_id = (SELECT exam_id FROM exams WHERE exam_status = 1)");
unset($_SESSION['id']);
session_destroy();
header("location:submited.php?msg=".$StudentSysIdVar);
?>
<?php
include('../includefiles/conn_db.php');
session_start();

$UnivIdVar=$_POST["univid"];

 $StudentCheckQur = mysqli_query($conn, "SELECT * FROM students WHERE student_nusu_id = '$UnivIdVar'");
 $row=mysqli_fetch_array($StudentCheckQur);


 if($row) {
	$_SESSION['id'] = $row['student_sys_id'];

	mysqli_query($conn, "INSERT INTO sessions (exam_id, student_sys_id, session_start_date, session_start_time)VALUES ((SELECT exam_id FROM exams WHERE exam_status = 1),".$row['student_sys_id'].", CURDATE(), CURTIME())");
	header('Location:exam.php');

   }

else
{

  header("location:index.php?msg=Wrong%20University%20ID");
  }


?>

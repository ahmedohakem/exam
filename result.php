<?php
//DATABASE CONNECTION & SESSION CHECK:
include('../includefiles/conn_db.php');
include('includefiles/hf.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/ico" href="img/logo.png" />
<link rel="icon" type="image/ico" href="img/logo.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
</head>

<body>
<?php
include('../includefiles/conn_db.php');
$examidVar=$_POST['exam'];
$ExamDetailsQur = "SELECT * FROM exams WHERE exam_id = $examidVar";
$ExamDetailsQurRun = mysqli_query($conn, $ExamDetailsQur);

while($row = mysqli_fetch_array($ExamDetailsQurRun))
{
$ExamFacultyVar = $row['e_faculty'];
$ExamBatchLevelVar = $row['e_year'];
$ExamSubjectVar = $row['e_subject'];
$ExamDateVar = $row['e_date'];
$ExamFullMarkVar = $row['e_full_mark'];
}
?>
<div align="center">
<?php echo $header; ?>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="80%" height="96" border="0" cellspacing="10">
    <tr>
      <td width="17%"><strong>Issued In:</strong></td>
      <td width="83%"><div align="left"><code><?php echo DATE('Y.m.d'); ?></code></div></td>
    </tr>
	    <tr>
      <td><strong>Exam Date:</strong></td>
      <td><div align="left"><code><?php echo $ExamDateVar;; ?></code></div></td>
    </tr>
    <tr>
      <td><strong>Faculty:</strong></td>
      <td><div align="left"><code><?php echo $ExamFacultyVar; ?>, Year <?php echo $ExamBatchLevelVar; ?></code></div></td>
    </tr>
    <tr>
      <td><strong>Subject:</strong></td>
      <td><div align="left"><code><?php echo $ExamSubjectVar; ?> <!--[<?php //echo $atensubcodeVar; ?>]--></code></div></td>
    </tr>
	    <tr>
      <td><strong>Full Mark:</strong></td>
      <td><div align="left"><code><?php echo $ExamFullMarkVar; ?> <!--[<?php //echo $atensubcodeVar; ?>]--></code></div></td>
    </tr>
    <tr>
              <td colspan="2"><hr align="center" width='100%' /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<?php
$n=1;
// REMEBER LINE NUMBER 77 AND ADD:
//			AND st.student_nusu_id like '%PA%'

$resultqur = mysqli_query($conn, "SELECT ver.Marks , st.student_name, st.student_nusu_id
FROM (
SELECT COUNT(a.record_id) AS Marks , a.student_sys_id AS StSysId
FROM questions q, answers a
WHERE q.q_id = a.q_id
AND q.exam_id = '$examidVar'
AND CONCAT('op',q.opv) = a.op_selected
GROUP BY a.student_sys_id) ver, students st
WHERE ver.StSysId = st.student_sys_id
AND st.student_sys_id != 4430

ORDER BY st.student_nusu_id");
$studentcount = mysqli_num_rows($resultqur);
if(mysqli_num_rows($resultqur) == 0) {
echo "<font color = 'red'>" . "&nbsp&nbsp&nbsp&nbsp No Data Found Matching Your Query." . "</font>" . "<br>";
}
else
{
echo "<table border='1' width='60%'>
<tr bgcolor = '#C8BBBE'>
<th>#</th>
<th>University ID</th>
<th>Student Name</th>
<th>Marks</th>

</tr>";
while($row = mysqli_fetch_array($resultqur))
  {
  echo "<tr onMouseOver=this.className='highlighttab' onMouseOut=this.className='normaltab'>";
  echo "<td  align= 'left'>" . $n . "</td>";
  echo "<td  align= 'left'>" . $row['student_nusu_id'] . "</td>";
  echo "<td  align= 'right'>" . $row['student_name'] . "</td>";
  echo "<td  align= 'center'>" . $row['Marks'] . "</td>";
  
  
  
  echo "</tr>";
  $n++;
  }
  echo "</table>";
  }
?>
<p>&nbsp;</p>
	<p>&nbsp;</p>
  <hr width="70%">
  <?php echo $footer; ?>
</div>
</body>
</html>
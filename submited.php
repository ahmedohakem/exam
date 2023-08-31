<?php include('includefiles/hf.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript">
window.setTimeout(function() {
    window.location.href = 'index.php';
}, 5000);
</script>
<link rel="shortcut icon" type="image/ico" href="img/logo.png" />
<link rel="icon" type="image/ico" href="img/logo.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
</head>

<body>
<?php
include('../includefiles/conn_db.php');
$StudentInfoQur = "SELECT * FROM students WHERE student_sys_id =".$_GET['msg'];
$StudentInfoQurRun = mysqli_query($conn, $StudentInfoQur);
while($row = mysqli_fetch_array($StudentInfoQurRun))
{
$StudentUnivIdVar = $row['student_nusu_id'];
$StudentNameVar = $row['student_name'];
}
?>
<center>
<?php echo $header; ?>

  <p>&nbsp; </p>

  <p>
  <font color="blue">
  Your Answers Submit Successfully
  <br>
  <?php echo $StudentNameVar; ?> [<?php echo $StudentUnivIdVar; ?>]
  </font>
  </p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
 <hr width="80%">
<?php echo $footer; ?>
    </center>
</body>
</html>

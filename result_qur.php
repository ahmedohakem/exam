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
<div align="center">
<?php echo $header; ?>

  <form method="POST" action="result.php">

  <table width="700" border="0" cellspacing="9">
   	    <tr>
	<td>
	  <select name = 'exam'>
	    <option selected value = ''>------ Select The Exam ------</option>
	    <?php
$qur = "SELECT * FROM exams ORDER BY e_date DESC";
$qurrun = mysqli_query($conn, $qur);
while($row=mysqli_fetch_array($qurrun))
{
$examid = $row['exam_id'];
$examfac = $row['e_faculty'];
$examsubject = $row['e_subject'];
echo '<option value="'.$examid.'">'.$examfac.' - '.$examsubject.'</option>';
}
?>
	    </select>
	  </td>
	</tr>

	    <tr>
	      <td colspan="2"><div align="center">
	       <br> <input type = 'submit' value = 'NEXT' style='height: 44px; width: 200px; font-size:100%;font-family:big'>
          </div></td>
    </tr>
  </table>
  </form>
    <p>&nbsp;</p>
	<p>&nbsp;</p>
	    <p>&nbsp;</p>
	<p>&nbsp;</p>
  <hr width="70%">
  <?php echo $footer; ?>
</div>
</body>
</html>
<?php
include('includefiles/sess.php');
include('includefiles/hf.php');
include('includefiles/conn_db.php');
?>
<!DOCTYPE html>
<html>
  <head>
<link rel="stylesheet" href="CounterFiles/countup/jquery.countup.css" />
<script src="CounterFiles/jquery-1.8.2.min.js"></script>
<script src="CounterFiles/countup/jquery.countup.js"></script>
<script src="CounterFiles/js/script.js"></script>
<link rel="shortcut icon" type="image/ico" href="img/logo.png" />
<link rel="icon" type="image/ico" href="img/logo.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, textarea, label, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      position: absolute;
      margin: 0;
      font-size: 40px;
      color: #fff;
      z-index: 2;
      line-height: 83px;
      }
      textarea {
      width: calc(100% - 12px);
      padding: 5px;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #fff;
      box-shadow: 0 0 8px  #669999; 
      }
      .banner {
      position: relative;
      height: 300px;
      background-image: url("/uploads/media/default/0001/02/c1504011491c4e04e5158b63a27a4ea654b03ed1.jpeg");  
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.2); 
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, select, textarea {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      }
      input[type="date"] {
      padding: 4px 5px;
      }
      textarea {
      width: calc(100% - 12px);
      padding: 5px;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder {
      color:  #669999;
      }
      .item input:hover, .item select:hover, .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 3px 0  #669999;
      color: #669999;
      }
      .item {
      position: relative;
      margin: 10px 0;
      }
      .item span {
      color: red;
      }
      .week {
      display:flex;
      justfiy-content:space-between;
      }
      .colums {
      display:flex;
      justify-content:space-between;
      flex-direction:row;
      flex-wrap:wrap;
      }
      .colums div {
      width:48%;
      }
      input[type="date"]::-webkit-inner-spin-button {
      display: none;
      }
      .item i, input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      font-size: 20px;
      color:  #a3c2c2;
      }
      .item i {
      right: 1%;
      top: 30px;
      z-index: 1;
      }
      input[type=radio], input[type=checkbox]  {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      margin: 5px 20px 15px 0;
      cursor: pointer;
      }
      .question span {
      margin-left: 30px;
      }
      .question-answer label {
      display: block;
      }
      label.radio:before {
      content: "";
      position: absolute;
      left: 0;
      width: 17px;
      height: 17px;
      border-radius: 50%;
      border: 2px solid #ccc;
      }
      input[type=radio]:checked + label:before, label.radio:hover:before {
      border: 2px solid  #669999;
      }
      label.radio:after {
      content: "";
      position: absolute;
      top: 6px;
      left: 5px;
      width: 8px;
      height: 4px;
      border: 3px solid  #669999;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      .flax {
      display:flex;
      justify-content:space-around;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background:  #669999;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background:  #a3c2c2;
      }
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .name-item div {
      width: calc(50% - 20px);
      }
      .name-item div input {
      width:97%;}
      .name-item div label {
      display:block;
      padding-bottom:5px;
      }
      }
    </style>
  </head>
  <body>
<?php
$StudentSysIdVar = $_SESSION['id'];
$ExamQuestionQur = "SELECT * FROM questions WHERE exam_id = (SELECT exam_id FROM exams WHERE exam_status = 1) ORDER BY rand()"; 
$ExamQuestionQurRun = mysqli_query($conn, $ExamQuestionQur);

$ExamInfoQur = "SELECT e_faculty, e_year, e_subject, ((e_duration_in_mint * 60) * 1000) AS e_duration_in_mlsec, SUBSTRING_INDEX(e_duration_in_format, ':', 2) AS e_duration_in_format FROM exams WHERE exam_status = 1";
$ExamInfoQurRun = mysqli_query($conn, $ExamInfoQur);
while($row = mysqli_fetch_array($ExamInfoQurRun))
{
$ExamFacultyVar = $row['e_faculty'];
$ExamBatchLevelVar = $row['e_year'];
$ExamSubjectVar = $row['e_subject'];
$ExamTimeVar = $row['e_duration_in_format'];
$ExamDurationInMlSecondVar = $row['e_duration_in_mlsec'];
}

$StudentInfoQur = "SELECT * FROM students WHERE student_sys_id = '$StudentSysIdVar'";
$StudentInfoQurRun = mysqli_query($conn, $StudentInfoQur);
while($row = mysqli_fetch_array($StudentInfoQurRun))
{
$StudentUnivIdVar = $row['student_nusu_id'];
$StudentNameVar = $row['student_name'];
}
?>
<center>
<?php echo $header; ?>
  </center>
  <div id="countdown"></div>
  <table width="50%" height="96" border="0" cellspacing="10">
    <tr>
      <td><strong>Date:</strong></td>
      <td><code><?php echo DATE('Y.m.d'); ?></code></td>
    </tr>
    <tr>
      <td><strong>Faculty:</strong></td>
      <td><code><?php echo $ExamFacultyVar; ?>, Year <?php echo $ExamBatchLevelVar; ?></code></td>
    </tr>
    <tr>
      <td><strong>Subject:</strong></td>
      <td><code><?php echo $ExamSubjectVar; ?> <!--[<?php //echo $atensubcodeVar; ?>]--></code></td>
    </tr>

		    <tr>
      <td><strong>Time:</strong></td>
      <td><code><?php echo $ExamTimeVar; ?> [HH:MM]</code></td>
    </tr>
		    <tr>
      <td><strong>Student:</strong></td>
      <td><code><?php echo $StudentNameVar; ?> [<?php echo $StudentUnivIdVar; ?>]</code></td>
    </tr>

  </table>
    <div class='testbox'>
<form method="post" action="submit.php" onsubmit="SubmitionButton.disabled = true; return true;" id = "ExamForm">
<input type="hidden" name="StudentSysId" value="<?php echo $StudentSysIdVar; ?>">
<?php
$n=1;
while($row = mysqli_fetch_array($ExamQuestionQurRun))
  {
echo "
       <div class='question'>
          <label><p><b>".$n.":&nbsp;</b>".$row['q_text']."</p></label>
          <div class='question-answer'>
            <div>
              <input type='radio' value='op1' id='".$row['q_id']."op1' name='".$row['q_id']."'/>
              <label for='".$row['q_id']."op1' class='radio'><span>".$row['op1']."</span></label>
            </div>
            <div>
              <input  type='radio' value='op2' id='".$row['q_id']."op2' name='".$row['q_id']."'/>
              <label for='".$row['q_id']."op2' class='radio'><span>".$row['op2']."</span></label>
            </div>
            <div>
              <input  type='radio' value='op3' id='".$row['q_id']."op3' name='".$row['q_id']."'/>
              <label for='".$row['q_id']."op3' class='radio'><span>".$row['op3']."</span></label>
            </div>
            <div>
              <input  type='radio' value='op4' id='".$row['q_id']."op4' name='".$row['q_id']."'/>
              <label for='".$row['q_id']."op4' class='radio'><span>".$row['op4']."</span></label>
            </div>
            <div>
              <input  type='radio' value='op5' id='".$row['q_id']."op5' name='".$row['q_id']."'/>
              <label for='".$row['q_id']."op5' class='radio'><span>".$row['op5']."</span></label>
            </div>
			
          </div>
        </div>
<hr width='100%' /><p>&nbsp;</p>
";
$n++;
  }
?>

<center>
<input type = 'submit' value = 'Submit Answers' name="SubmitionButton" style='height: 44px; width: 200px; font-size:100%;font-family:big'>  
</center>
      </form>
    </div>
	<center>
  <p>&nbsp;</p>
  <p>&nbsp; </p> 
  <p>&nbsp; </p>
  <hr width="50%">
<?php echo $footer; ?>
  <p>&nbsp; </p>
</center>
<script type="text/javascript">
setTimeout( "document.getElementById('ExamForm').submit();", <?php echo $ExamDurationInMlSecondVar; ?> );
</script>
  </body>
</html>
<?php
include("config.php");
session_start();
if (isset($_SESSION['id']))
{ ?>
<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Data entry Page</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link href='cashback-512.png' rel='icon' type='image/x-icon'/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
	<body><nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">ID <?php echo $_SESSION['id']; ?></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="main.php">Home</a></li> 
        <li><a href="insert.php">Data entry</a></li>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<div class="container">
  <h2>Chargeback Management System</h2><br>
 <form class="col-md-6" method="post">
  <div class="form-group">
   <label>Acquirg Bank</label>
    <input type="text" name="A" class="form-control">
  </div>
   <div class="form-group">
   <label>Case ID</label>
    <input type="text" name="B" class="form-control">
  </div>
   <div class="form-group">
   <label>Chargeback Reason</label>
    <input type="text" name="C" class="form-control">
  </div>
   <div class="form-group">
   <label>Card Number</label>
    <input type="text" name="D" class="form-control">
  </div>
   <div class="form-group">
   <label>Transaction Date</label>
    <input type="text" name="E" class="form-control">
  </div>
   <div class="form-group">
   <label>Transaction Time</label>
    <input type="text" name="F" class="form-control">
  </div>
  <div class="form-group">
   <label>Transaction Amount</label>
    <input type="text" name="G" class="form-control">
  </div>
 <div class="form-group">
   <div class="form-group">
    <input type="submit" name="submit_user" class="btn btn-primary">
   </div>
</form>
</div></body></html>

<?php

	if (isset($_POST['submit_user']))
	{
		$A = mysqli_real_escape_string($conn,strip_tags($_POST['A']));
		$B = mysqli_real_escape_string($conn,strip_tags($_POST['B']));
		$C = mysqli_real_escape_string($conn,strip_tags($_POST['C']));
		$D = mysqli_real_escape_string($conn,strip_tags($_POST['D']));
		$E = mysqli_real_escape_string($conn,strip_tags($_POST['E']));
		$F = mysqli_real_escape_string($conn,strip_tags($_POST['F']));
		$G = mysqli_real_escape_string($conn,strip_tags($_POST['G']));
		$ins_sql = "insert into data (A,B,C,D,E,F,G,timestamp) values ('$A','$B','$C','$D','$E','$F','$G',NOW())";
		$run = mysqli_query($conn,$ins_sql);
		echo '<script>alert("Done")</script>';
	}
}
else
{
	header("location: index.php");
}
?>

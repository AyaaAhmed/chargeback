<?php
include("config.php");
session_start();
if (isset($_SESSION['id']))
{?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Main Page</title>
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
  <h2>Chargeback Management System</h2>
	<?php
	if (isset($_GET['edit_no']))
	{
		$sql = "select * from data where B='$_GET[edit_no]'";
		$run = mysqli_query($conn,$sql);
		while( $rows = mysqli_fetch_assoc($run))
		{
			$A = $rows['A'];
			$B = $rows['B'];
			$C = $rows['C'];
			$D = $rows['D'];
			$E = $rows['E'];
			$F = $rows['F'];
			$G = $rows['G'];
		}
	?>
	
		<form class="col-md-6" method="post">
		<div class="form-group">
		<label>Acquirg Bank</label>
		<input type="text" name="edit_A" value="<?php echo $A; ?>" class="form-control" required autofocus>
		</div>
		<div class="form-group">
		<label>Case ID</label>
		<input type="text" name="edit_B" value="<?php echo $B; ?>" class="form-control" required readonly>
		</div>
		<div class="form-group">
		<label>Chargeback Reason</label>
		<input type="text" name="edit_C" value="<?php echo $C; ?>" class="form-control" required>
		</div>
		<div class="form-group">
		<label>Card Number</label>
		<input type="text" name="edit_D" value="<?php echo $D; ?>" class="form-control" required>
		</div>
		<div class="form-group">
		<label>Transaction Date</label>
		<input type="text" name="edit_E" value="<?php echo $E; ?>" class="form-control" required>
		</div>
		<div class="form-group">
		<label>Transaction Time</label>
		<input type="text" name="edit_F" value="<?php echo $F; ?>" class="form-control" required>
		</div>
		<div class="form-group">
		<label>Transaction Amount</label>
		<input type="text" name="edit_G" value="<?php echo $G; ?>" class="form-control" required>
		</div>
		<div class="form-group">
		<div class="form-group">
		<input type="hidden" value="<?php echo $_GET['edit_no']?> name="edit_id">
		<input type="submit" value="Done" name="edit_user" class="btn btn-info">
		<a href="main.php" class="btn btn-warning" role="button">Cancel</a>
		</div>
		</form>

	<?php }
	?>

	<?php
	$sql = "select * from data";
	$run = mysqli_query($conn,$sql);
	echo "<p align='right'><form method='post' action='excel.php' ><input type='submit' name='export_excel' value='Export' class='btn btn-link'><img src='export.ico'></img></form></p><table class='table'><thead><tr><th>Acquirg Bank</th><th>Case ID</th><th>Chargeback Reason</th><th>Card Number</th><th>Date</th><th>Time</th><th>Amount</th><th>Last Updated</th><th>Edit</th></tr></thead></tbody>";
	while($rows = mysqli_fetch_assoc($run))
	{
		echo "<tr><td>$rows[A]</td><td>$rows[B]</td><td>$rows[C]</td><td>$rows[D]</td><td>$rows[E]</td><td>$rows[F]</td><td>$rows[G]</td><td>$rows[timestamp]</td><td><a href='main.php?edit_no=$rows[B]' class='btn btn-success'>Edit</a></td></tr>";
	}
	echo "</tbody></table></div>";
	?>
	<?php
	if( isset($_POST['edit_user']))
	{
		$edit_A = mysqli_real_escape_string($conn,strip_tags($_POST['edit_A']));
		$edit_B = mysqli_real_escape_string($conn,strip_tags($_POST['edit_B']));
		$edit_C = mysqli_real_escape_string($conn,strip_tags($_POST['edit_C']));
		$edit_D = mysqli_real_escape_string($conn,strip_tags($_POST['edit_D']));
		$edit_E = mysqli_real_escape_string($conn,strip_tags($_POST['edit_E']));
		$edit_F = mysqli_real_escape_string($conn,strip_tags($_POST['edit_F']));
		$edit_G = mysqli_real_escape_string($conn,strip_tags($_POST['edit_G']));
		
		$edit_no = $_POST['edit_no'];
		
		$edit_sql = "update data set A = '$edit_A', C = '$edit_C', D = '$edit_D' , E = '$edit_E' ,F = '$edit_F',G = '$edit_G',timeStamp = NOW() where B = '$edit_B'";
		
		if(mysqli_query($conn,$edit_sql))
		{ ?>
			<script> window.location = "main.php";</script>
	  <?php } 
		else
		{
			echo "An error has occurred. Please contact your system administrator<br>".mysqli_error($conn);
		}
	}

}
else
{
	header("location: index.php");
}
?>

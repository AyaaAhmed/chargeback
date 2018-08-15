<?php
include("config.php");
session_start();
if (isset($_SESSION['id']))
{
	$output = '';
	if(isset($_POST["export_excel"]))
	{
		$sql = "SELECT * FROM data";
		$result = mysqli_query($conn, $sql);
		if(mysqli_query($conn,$sql))
		{
			if(mysqli_num_rows($result) > 0)
			{
				$output .='<table class="table" bordered="1"><thead><tr><th>Acquirg Bank</th><th>Case ID</th><th>Chargeback Reason</th><th>Card Number</th><th>Date</th><th>Time</th><th>Amount</th><th>Last Updated</th></tr></thead></tbody>';
				while($row = mysqli_fetch_array($result))
				{
					$output .= '<tr><td>'.$row["A"].'</td><td>'.$row["B"].'</td><td>'.$row["C"].'</td><td>'.$row["D"].'</td><td>'.$row["E"].'</td><td>'.$row["F"].'</td><td>'.$row["G"].'</td><td>'.$row["timestamp"].'<td></tr>';
				}
				$output .= '</table>';
				header("Content-Type: application/xls");
				$date = date('Y-m-d h:i:s');
				header("Content-Disposition: attachment; filename=$date.xls");
				echo $output;
			}
			else
			{
				echo "Database is Empty";
			}
		}
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
<html><head><title>Export to Excel</title><link href='cashback-512.png' rel='icon' type='image/x-icon'/></head></html>

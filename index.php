<?php
include("config.php");
session_start();
if (!isset($_SESSION['id']))
{

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$id = mysqli_real_escape_string($conn,strip_tags($_POST['id']));
		$mypassword = mysqli_real_escape_string($conn,$_POST['password']);
		$password = md5($mypassword);
		
		if ( $id == 0 )
		{
			$error = "You Can't Login as admin";
		}
		else
		{
			$sql = "SELECT id FROM users WHERE id = '$id' and password = '$password'";
			$result = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($result);

			if($count == 1)
			{
				$_SESSION['id'] = $id;
				header("location: main.php");
			}
			else
			{
				$error = "Your Login Name or Password is invalid";
			}
		}
	}
}
else
{
	header("location: main.php");
}
?>

<!DOCTYPE html>
 <html>
      <head>
	 <link href='cashback-512.png' rel='icon' type='image/x-icon'/>
           <title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
      </head>
      <body>
           <br /><br />
           <div class="container" style="width:500px;">
                <br />
                <h2 align="center">Welcome</h2>
                <br />
                <form method="post">
                     <label>Enter ID</label>
                     <input type="number" name="id" class="form-control" required/>
                     <br />
                     <label>Enter Password</label>
                     <input type="password" name="password" class="form-control" required />
                     <br />
                     <input type="submit" name="register" value="Login" class="btn btn-info" />
                     <br />
                     <p align="center"><a href="register.php" >Create an account</a></p>
                </form>
	<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
           </div>
      </body>
 </html>

<?php
include("config.php");
session_start();
if (!isset($_SESSION['id']))
{
	if(isset($_POST["register"]))
	{
		$id = mysqli_real_escape_string($conn,strip_tags($_POST['id']));
		$f_name = mysqli_real_escape_string($conn,strip_tags($_POST["f_name"]));
		$l_name = mysqli_real_escape_string($conn,strip_tags($_POST["l_name"]));
		$password = mysqli_real_escape_string($conn,$_POST["password"]);
		$password = md5($password);
		
		$adpassword = mysqli_real_escape_string($conn, $_POST["adpassword"]);
		$adpassword = md5($adpassword);

		$sql = "SELECT id FROM users WHERE id = '00000' and password = '$adpassword'";
		$result = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($result);

		if( $count == 1 )
		{
			$query = "INSERT INTO users(id,f_name,l_name, password) VALUES('$id','$f_name','$l_name', '$password')";
			$sql = "SELECT id FROM users WHERE id = '$id'";
			$result = mysqli_query($conn,$sql);
			$count = mysqli_num_rows($result);
			if(strlen($id) > 15 )
			{
				$error="Long ID";
			}
			else
			{
				if( $count == 1 )
				{
					$error="That ID is taken. Try another.";
				}
				else
				{
					if(mysqli_query($conn, $query))
					{
						echo '<script>alert("Registration Done")</script>';
					}
					else
					{
						$dberror="An error has occurred. Please contact your system administrator<br>".mysqli_error($conn);
					}
				}
			}
		}
		else
		{
			$aderror = "Password is invalid";
		}

	}
}
else
{
	header("location: main.php");
}
?>
 <html>
      <head>
           <title>Registration Page</title><link href='cashback-512.png' rel='icon' type='image/x-icon'/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      </head>
      <body>
           <br /><br />
           <div class="container" style="width:500px;">
                <br />
                <h2 align="center"><b>Registration</h2>
                <br />
                <form method="post">
                     <label>Enter ID</label>
                     <input type="number" name="id" class="form-control" required/>
                     <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
                     <br />
                     <label>Enter First Name</label>
                     <input type="text" name="f_name" class="form-control" required/>
                     <br />
                      <label>Enter Last Name</label>
		     <input type="text" name="l_name" class="form-control" required/>
		     <br />
		     <label>Enter Password</label>
		     <input type="password" name="password" class="form-control" required/>
		     <br />
		     <label>Administrator Password</label>
		     <input type="password" name="adpassword" class="form-control" required/>
		     <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $aderror; ?></div>
		     <br />
                     <input type="submit" name="register" value="Register" class="btn btn-info" />
                     <br />
                     <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $dberror; ?></div>
                </form>
           </div>
      </body>
 </html>

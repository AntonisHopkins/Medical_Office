<?php 
SESSION_START();
require_once("connection.php");
if(!empty($_POST["username"]) && !empty($_POST["password"]))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
			if($result = $mysqli->query("SELECT * FROM user  WHERE username='".$username."' AND password='".$password."'"))
			{
				if($result->num_rows)
					{
						$user_data = mysqli_fetch_array($result);
						$_SESSION["username"]=$user_data["username"];
						$_SESSION["password"]=$user_data["password"];
						header("Location: adminpage.php");
						$mysqli->close();
						exit();
					}
			}
	}
$mysqli->close();
header("Location: index.html");
 ?>
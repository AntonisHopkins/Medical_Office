
<?php
session_start();
require_once("../connection.php"); //Fernei ton kodika tou arxeiou pou einai i sindesi tis vasis.
if($_SESSION["password"]!=null) //An exei kanei login o admin tote na exei prosvasi se auto to page
{	
	if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["health_insurance"])) //An exei valei dedomena sto textbox kai dn einai empty
	{
		$_SESSION["msg"]= "<script type='text/javascript'> alert('Your patient has been removed!');</script>";
		$firstname=$_POST["firstname"];
		$lastname=$_POST["lastname"];
		$insurance=$_POST["health_insurance"];
		$mysqli->query(" DELETE from patient WHERE (firstname='".$firstname."' AND lastname='".$lastname."' AND health_insurance='".$insurance."')"); 
		if($mysqli->affected_rows==0) {
			$_SESSION["msg"]="<script type='text/javascript'> alert('Error, there is no user with those credentials!');</script>";
			header("Location: ../adminpage.php");
			exit;
		}
	}else
		$_SESSION["msg"]="<script type='text/javascript'> alert('You did not fill all the fields!');</script>";//Apothikeuse to minima oti dn exei dwsei dedomena sto textbox
}
$mysqli->close();
header("Location: ../adminpage.php");// Pane piso sto adminpage
?>
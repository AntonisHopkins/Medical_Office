<?php
session_start();
require_once("../connection.php"); //Fernei ton kodika tou arxeiou pou einai i sindesi tis vasis.
if($_SESSION["password"]!=null) //An exei kanei login o admin tote na exei prosvasi se auto to page
{	
	if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["health_insurance"])) //An exei valei dedomena sto textbox kai dn einai empty
	{
		$_SESSION["msg"]= "<script type='text/javascript'> alert('Your patient has signed in!');</script>";
		$firstname=$_POST["firstname"];
		$lastname=$_POST["lastname"];
		$insurance=$_POST["health_insurance"];
		$mysqli->query("INSERT INTO  patient(firstname,lastname,health_insurance) VALUES('".$firstname."','".$lastname."','".$insurance."')") or $_SESSION["msg"]= "<script type='text/javascript'> alert('Error, there is already an user with that health_insurance code!');</script>" and header("Location: ../adminpage.php");
	}else
		$_SESSION["msg"]="<script type='text/javascript'> alert('You did not fill all the fields!');</script>";//Apothikeuse to minima oti dn exei dwsei dedomena sto textbox
}
$mysqli->close();
header("Location: ../adminpage.php");// Pane piso sto adminpage
?>
<?php
session_start();
require_once("../connection.php"); //Fernei ton kodika tou arxeiou pou einai i sindesi tis vasis.
if($_SESSION["password"]!=null) //An exei kanei login o admin tote na exei prosvasi se auto to page
{	
	if(!empty($_POST["date"]) && !empty($_POST["hour"])) //An exei valei dedomena sto textbox kai dn einai empty
	{
		$_SESSION["msg"]= "<script type='text/javascript'> alert('The appointment has been removed!');</script>";
		$date=$_POST["date"];
		$hour=$_POST["hour"];
		if(checkdate(substr($date,3,2),substr($date,0,2),substr($date,6,4)) && preg_match("/^(2[0-3]|[0-1][0-9]|[0-9]):([0-5][0-9])/", $hour)) //An i imerominia kai i ora einai sosta dosmeni
			{
				$date= date("Y-m-d", strtotime($date));//kanei tin ora se yyyy-mm-dd gt etsi ta dexete i vasi
				$result=$mysqli->query("DELETE from schedule where date='".$date."' AND hour='".$hour."'");
				if($mysqli->affected_rows==0) 
				{
					$_SESSION["msg"]="<script type='text/javascript'> alert('Error, there is no appointment that datetime!');</script>";
					header("Location: ../adminpage.php");
					exit;
				}
			}else
				$_SESSION["msg"]="<script type='text/javascript'> alert('The assign could not be completed, please check the date and time syntax!');</script>"; //An i ora kai i imerominia dn einai sosta dosmeni tote erxete edw apothikeuei to minima kai meta paei sto $mysqli->close(); klp.
	}else{
		$_SESSION["msg"]="<script type='text/javascript'> alert('You did not fill all the fields!');</script>";//Apothikeuse to minima oti dn exei dwsei dedomena sto textbox
	}
}
$mysqli->close();
header("Location: ../adminpage.php");// Pane piso sto adminpage
?>
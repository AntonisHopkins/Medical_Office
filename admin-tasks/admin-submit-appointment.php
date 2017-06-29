<?php 
require_once("../connection.php");
session_start();
if($_SESSION["password"]!=null) //An exei kanei login o admin tote na exei prosvasi se auto to page
{
	if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["health_insurance"]) && !empty($_POST["date"])
		&& !empty($_POST["hour"])) //An exei valei dedomena sto textbox kai dn einai empty
	{
		$firstname=$_POST["firstname"];
		$lastname=$_POST["lastname"];
		$insurance=$_POST["health_insurance"];
		$date=$_POST["date"];
		$hour=$_POST["hour"];
			if(checkdate(substr($date,3,2),substr($date,0,2),substr($date,6,4)) && preg_match("/^(2[0-3]|[0-1][0-9]|[0-9]):([0-5][0-9])/", $hour)) //An i imerominia kai i ora einai sosta dosmeni 
			{
				$date= date("Y-m-d", strtotime($date));//kanei tin ora se yyyy-mm-dd gt etsi ta dexete i vasi
				$result=$mysqli->query("SELECT id from patient WHERE firstname='".$firstname."' AND lastname='".$lastname."' AND health_insurance='".$insurance."'");
				if($result->num_rows==0)// An sto parapanw erotima dn iparxei o asthenis me ta stoixeia tote mpes mesa kai kanton eggrafi
				{
					if(!$mysqli->query("INSERT INTO  patient(firstname,lastname,health_insurance) VALUES('".$firstname."','".$lastname."','".$insurance."')"))
					{
						$_SESSION["msg"]= "<script type='text/javascript'> alert('Error, there is already another user with that health_insurance code!');</script>"; 
					  	header("Location:../adminpage.php");
					 	exit;
					}
					$result = $mysqli->query("SELECT id from patient WHERE firstname='".$firstname."' AND lastname='".$lastname."'  AND health_insurance='".$insurance."'"); // Ksanakalese ton astheni (afou autoi tn fora 9a iparxei)
				}
				$user_data = $result->fetch_array();
				$date= date("Y-m-d", strtotime($date));//kanei tin ora se yyyy-mm-dd gt etsi ta dexete i vasi
				if($mysqli->query("INSERT INTO  schedule (patient_id, date ,hour) VALUES('".$user_data["id"]."','".$date."','".$hour."')"))
				{
					$_SESSION["msg"]="<script type='text/javascript'> alert('Appointment signed.');</script>";
				}else
					$_SESSION["msg"]="<script type='text/javascript'> alert('The assign could not be completed, date is closed for this datetime!');</script>";
			}else
				$_SESSION["msg"]="<script type='text/javascript'> alert('The assign could not be completed, please check the date and time syntax!');</script>"; //An i ora kai i imerominia dn einai sosta dosmeni tote erxete edw apothikeuei to minima kai meta paei sto $mysqli->close(); klp.
	}else
		$_SESSION["msg"]="<script type='text/javascript'> alert('You did not fill all the fields!');</script>";
}
	$mysqli->close();
	header("Location:../adminpage.php");// Pane piso sto adminpage
?>
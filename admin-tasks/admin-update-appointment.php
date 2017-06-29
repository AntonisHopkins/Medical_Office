<?php
session_start();
require_once("../connection.php");//Fernei ton kodika tou arxeiou pou einai i sindesi tis vasis.
if($_SESSION["password"]!=null) //An exei kanei login o admin tote na exei prosvasi se auto to page
{
	if(!empty($_POST["date"]) && !empty($_POST["hour"])) //An exei valei dedomena sto textbox kai dn einai empty
	{
		$oldate=$_POST["oldate"];
		$oldtime=$_POST["oldtime"];
		$date=$_POST["date"];
		$hour=$_POST["hour"];
		if(checkdate(substr($date,3,2),substr($date,0,2),substr($date,6,4)) && preg_match("/^(2[0-3]|[0-1][0-9]|[0-9]):([0-5][0-9])/", $hour)) //An i imerominia kai i ora einai sosta dosmeni 
		{
			$date= date("Y-m-d", strtotime($date));//kanei tin ora se yyyy-mm-dd gt etsi ta dexete i vasi
			$oldate= date("Y-m-d", strtotime($oldate));
			if($mysqli->query("UPDATE schedule SET date='".$date."' , hour='".$hour."' WHERE date='".$oldate."' AND hour='".$oldtime."'"))
			{
				$_SESSION["msg"]="The date updated succesfully.";
				$_SESSION["code"]=0;
			}else
			{
				$_SESSION["msg"]="The date did not update succesfully. ".$mysqli->error;
				$_SESSION["code"]=1;
			}
		}else
		{
			$_SESSION["msg"]="Check the date and time syntax!";
			$_SESSION["code"]=1;
		}
	}else{
		$_SESSION["code"]=1;
		$_SESSION["msg"]="You did not fill all the fields.";
	}
}
$mysqli->close();
?>
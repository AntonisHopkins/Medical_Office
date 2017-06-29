<?php
session_start();
require_once("../connection.php");  //Fernei ton kodika tou arxeiou pou einai i sindesi tis vasis.
if($_SESSION["password"]!=null) //An exei kanei login o admin tote na exei prosvasi se auto to page
{	
	if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["drugs"]) && !empty($_POST["prescription"])) //An exei valei dedomena sto textbox kai dn einai empty
	{
		$_SESSION["msg"]= "<script type='text/javascript'> alert('Your patient has signed in!');</script>";
		$firstname=$_POST["firstname"];
		$lastname=$_POST["lastname"];
		$drug=$_POST["drugs"];
		$prescription=$_POST["prescription"];
		$result=$mysqli->query("SELECT id from patient WHERE firstname='".$firstname."' AND lastname='".$lastname."'");
				if($result->num_rows==1) //An sto apo panw sql erotima iparxei o patient 
				{
					$patient_id=$result->fetch_array()["id"];
					$drugs = explode(" ",$drug); // Xwrizei to String ana keno kai ta topothetei sto pinaka drugs
					foreach ($drugs as $key) //Pernei ena ena ta value tou pinaka drugs (dld ena ena ta farmaka) 
					{
							$drugs_result=$mysqli->query("SELECT id from drugs WHERE name='".$key."'") or $_SESSION["msg"]= "<script type='text/javascript'> alert('Error, there was an error try again!')</script>" and header("Location: ../adminpage.php");
								if($drugs_result->num_rows==0){//An to farmako pou edwse o giatros dn iparxei stin vasi
									$_SESSION["msg"]= "<script type='text/javascript'> alert('There is no such drug in the database!')</script>" and header("Location: ../adminpage.php"); //Apothikeuse to minima stin global metabliti Session kai pane piso sto adminpage.
									exit();	//stamata na ekteleis kodika	
								}						
							$mysqli->query("INSERT INTO patient_drugs(patient_id,drug_id,prescription) VALUES 
								('".$patient_id."', 
						'".$drugs_result->fetch_array()["id"]."','".$prescription."')");//Efoson iparxei to farmako kai o asthenis vale ta farmaka kai ton astheni sto table prescription
					}
					$_SESSION["msg"]= "<script type='text/javascript'> alert('Prescription was assigned!');</script>";
				}else
				 $_SESSION["msg"]= "<script type='text/javascript'> alert('Error, there is no patient with those data in the database!');</script>"; //An dn iparxei o asthenis apothikeuese auto to minima sto session
	}else
		$_SESSION["msg"]="<script type='text/javascript'> alert('You did not fill all the fields!');</script>";
}
$mysqli->close();
header("Location: ../adminpage.php"); // Pane piso sto adminpage
?>
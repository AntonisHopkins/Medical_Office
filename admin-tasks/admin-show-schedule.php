<?php 
require_once("../connection.php");
session_start();
if($_SESSION["password"]!=null) //An exei kanei login o admin tote na exei prosvasi se auto to page
{
	if(!empty($_GET["schedule"])) //An exei valei dedomena sto textbox kai dn einai empty
	{
		$schedule=$_GET["schedule"];
		if(checkdate(substr($schedule,3,2),substr($schedule,0,2),substr($schedule,6,4)))//An i imerominia sosta dosmeni YYYY-MM-DD 
			{
				$schedule= date("Y-m-d", strtotime($schedule));//kanei tin ora se yyyy-mm-dd gt etsi ta dexete i vasi
				$result=$mysqli->query("SELECT patient_id,date,hour from schedule WHERE date='".$schedule."'");//Fere oles tis imerominies tis sigkekrimenes ta patient_id, date, hour. 
				if($result->num_rows==0)//An dn iparxei rantevou tin tade imerominia mpes edw
				{
					$_SESSION["msg"]="<script type='text/javascript'> alert('There is no date assigned this day.');</script>";//Apothikeues to error message se auto to Global varriable na to emfaniseis sto adminpage
					header("Location: ../adminpage.php"); //Pane sto adminpage.
					exit();//Stamata na ekteleis ton kodika autou tou arxeiou
				}else{ //An Iparxoun rantevou tin sigkekrimeni imerominia
					echo"
					<html>
					<head>
						<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
						<title>Schedule List</title>
						<link type='text/css' rel='stylesheet' href='../css/index.css'/>
						<script src='//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
						<script type'text/javacript' src='../scripts/delete.js'></script>
						<script type'text/javacript' src='../scripts/update.js'></script>
					</head>
					<body>
					<div class='wrapper'>
						<div class='header'>
						<ul class='list' id='indexlist'>
							<li><a href='../index.html'>Home</a></li>
							<li><a href='../aboutme.php'>About Me</a></li>
							<li><a href='../work.php'>My Work</a></li>
							<li><a href='../adminpage.php'> Go Back </a></li>
							</ul>
							<br></br>
							<h3 id='myname'>DR<br/>PAPANIKOLAIDIS</h3>
							<h2>ANDROLOGOS/<br/>OUROLOGOS</h2>
						</div>
						<div class='leftsidebar'>
							<p>COMPLETE TEXT</p>
						</div>
						<div class='cntr' >
							<h1>Hello!</h1>
							<ul>
							<table border='1'>
							<tr>
							<th colspan='6'>Dates of the day!</th>
							</tr>
							<tr>
							<th>Date</th>
							<th>Time</th>
							<th>Patient</th>
							<th>Patient's Insurance</th>
							</tr>";
							while($record=$result->fetch_assoc()){ //Diasxisei ena ena oles tis imerominies pou 	girise to sql erotima to fetch_assoc kanei return 1 -1 tin imerominia
								$pat= $mysqli->query("SELECT firstname,lastname,health_insurance from patient WHERE id='".$record["patient_id"]."'");
								$patient= $pat->fetch_array();
								echo"<tr ><td class='date'>".date("d-m-Y", strtotime($record["date"]))."</td><td class='time'>".$record["hour"]."</td> <td class='patient_name'>".$patient["firstname"]." " .$patient["lastname"]."</td><td class='patient_insurance'>".$patient["health_insurance"]."</td>
								<td class='delete'>delete</td>
								<td class='update'>update</td></tr>";
							}
						echo"<p></p>
						</table>
						";
						if(!empty($_SESSION["msg"]))
						{
							echo "<p id='session' style='color:red'><b>".$_SESSION["msg"]."</b></p>";
							$_SESSION["msg"]=null;
						}
						if(!empty($_SESSION["code"]))
						{
							echo "<p id='code' hidden>".$_SESSION["code"]."</p>";
							$_SESSION["msg"]=null;
						}
						echo"
						</div>
						<div class='footer'>
						<ul class='list'>
						<li><a href='mailto:example@hotmail.com'>Email Me</a></li>
						</ul>
						<p><b>This is an website created during an university project for external medical offices.<b> Copyrights reserved to developer Antonis Misirgis.</b></p>
						</div>
					</div>
					</body>
				</html>";
				}
			}else //Se periptosi pou dn perase ton elexo tis imerominias (dn eixe sosto format)
				{
					$_SESSION["msg"]="<script type='text/javascript'> alert('Please check the date syntax!');</script>";
					header("Location: ../adminpage.php");//Pane sto adminpage.
				}

	}else{ //Se periptosi pou dn exei valei kati sto textBox
		$_SESSION["msg"]="<script type='text/javascript'> alert('You did not fill all the fields!');</script>";
		header("Location: ../adminpage.php");
	}
}
$mysqli->close();
 ?>
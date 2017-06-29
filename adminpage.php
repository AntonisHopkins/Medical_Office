<?php 
session_start();
If($_SESSION["password"] !=null)
{
	echo"<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>Adminpage</title>
		<link type='text/css' rel='stylesheet' href='./css/index.css'/>
		<link rel='stylesheet' type='text/css' href='http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css'/>
		<script src='//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
        <script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js'></script>
		<script type='text/javascript' src='./scripts/accordion.js'></script>
		<script type='text/javascript' src='./scripts/datepicker.js'></script>
	</head>
	<body>
	<div class='wrapper' >
		<div class='header'>
		<ul class='list'>
			<li><a href='./index.html'>Home</a></li>
			<li><a href='./aboutme.php'>About Me</a></li>
			<li><a href='./work.php'>My Work</a></li>
			<li><a href='./admin-tasks/logout.php'>Logout</a></li>
			</ul>
			<br></br>
			<h3 id='myname'>DR<br/>PAPANIKOLAIDIS</h3>
			<h2>ANDROLOGOS/<br/>OUROLOGOS</h2>
		</div>
		<div class='leftsidebar'>
		<div id='menu'>
			<h3><u><b>Add Appointment</b></u>:</h3>
			<div>
				<form action='./admin-tasks/admin-submit-appointment.php' method='POST'>
					<label for='firstname'>Firstname:</label>
						<input type='text' name='firstname' placeholder='patient`s firstname'><br/>
					<label for='lastname'>Lastname:</label>
						<input type='text' name='lastname' placeholder='patient`s lastname'><br/>
					<label for='health_insurance'>Health insurance:</label>
						<input type='text' name='health_insurance' placeholder='Health_insurance'><br/>
					<label for='date'>Date:</label>
						<input type='text' name='date' class='date' placeholder='DD-MM-YYYY'><br/>
					<label for='hour'>Hour:</label>
						<input type='text' name='hour' placeholder='HH:MM'>
					<input type='submit'></input>
				</form>
			</div>
			<h3><u><b>Add prescription</b></u>:</h3>
			<div>
				<form action='./admin-tasks/admin-submit-prescription.php' method='POST'>
					<label for='firstname'>Firstname:</label>
					<input type='text' name='firstname' placeholder='patient`s firstname'><br/>
					<label for='lastname'>Lastname:</label>
					<input type='text' name='lastname' placeholder='patient`s lastname'><br/>
					<label for='drugs'>Drugs:</label>
					<input type='text' name='drugs' placeholder='testosterone morfine etc'><br/>
					<label for='prescription'>Prescription:</label>
					<input type='text' name='prescription' placeholder='mg , doses etc...' l>
					<input type='submit'></input>
				</form>
			</div>
			<h3><u><b>Add patient</b></u>:</h3>
			<div>
				<form action='./admin-tasks/admin-submit-patient.php' method='POST'>
					<label for='firstname'>Firstname:</label>
						<input type='text' name='firstname' placeholder='patient`s firstname'><br/>
					<label for='lastname'>Lastname:</label>
						<input type='text' name='lastname' placeholder='patient`s lastname'><br/>
					<label for='health_insurance'>Health insurance:</label>
						<input type='text' name='health_insurance' placeholder='Health_insurance'>
					<input type='submit'></input>
				</form>
			</div>
			<h3><u><b>Check schedule</b></u>:</h3>
			<div>
				<form action='./admin-tasks/admin-show-schedule.php' method='GET'>
					<label for='schedule'>Date:</label>
						<input type='text' name='schedule' class='date' placeholder='Schedule of date'>
					<input type='submit'></input>
				</form>
			</div>
			<h3><u><b>Delete patient</b></u>:</h3>
			<div>
				<form action='./admin-tasks/admin-delete-patient.php' method='POST'>
					<label for='firstname'>Firstname:</label>
						<input type='text' name='firstname' placeholder='patient`s firstname'><br/>
					<label for='lastname'>Lastname:</label>
						<input type='text' name='lastname' placeholder='patient`s lastname'><br/>
					<label for='health_insurance'>Health insurance:</label>
						<input type='text' name='health_insurance' placeholder='Health_insurance'>
					<input type='submit'></input>
				</form>
			</div>
			<h3><u><b>Delete appointment</b></u>:</h3>
			<div>
				<form action='./admin-tasks/admin-delete-appointment.php' method='POST'>
					<label for='date'>Date:</label>
						<input type='text' name='date' class='date' placeholder='DD-MM-YYYY'><br/>
					<label for='hour'>Hour:</label>
						<input type='text' name='hour' placeholder='HH:MM'>
					<input type='submit'></input>
				</form>
			</div>
		</div>
		</div>
		<div class='cntr' >
			<h1>Hello!</h1>
		</div>
		<div class='footer'>
			<ul class='list'>
			<li><a href='mailto:example@hotmail.com'>Email Me</a></li>
			</ul>
			<p>This is an website for external medical offices. <b>Copyrights reserved to developer Antonis Misirgis</b></p>
		</div>
	</div>
	</body>
</html>";
	if(!empty($_SESSION["msg"])){
				echo"".$_SESSION["msg"]."";
			}
	$_SESSION["msg"]=NULL;
}else
	header("Location: index.html");
 ?>
$(document).ready(function(){
	$(".update").css("color", "blue");
	$(".update").css("cursor","pointer");
	$(".update").click(function(){
		var row =  $(this).closest("tr");
		var xhttp;
		var date =  prompt("Give new date. (dd-mm-yyyy)");
		var time = 	prompt("Give new time. (hh:mm)");
		var oldate = row.find(".date").text();
		var oldtime = row.find(".time").text();
		if (window.XMLHttpRequest) {
    		xhttp = new XMLHttpRequest();
    	}else
		{
   			xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xhttp.onreadystatechange = function() {
			if(xhttp.readyState==4 && xhttp.status==200)
			{
				$(".cntr p").load("../admin-tasks/admin-show-schedule.php?schedule="+oldate + " #session");
				var code= $("#code").html();
				if(code==0)
					row.remove();
			}
		};
		xhttp.open("POST","../admin-tasks/admin-update-appointment.php",true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("oldate=" + String(oldate) + "&oldtime="+ String(oldtime)+ "&date="+ String(date)+ "&hour="+ String(time));
	});
});
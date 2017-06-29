$(document).ready(function(){
	$(".delete").css("color", "red");
	$(".delete").css("cursor","pointer");
	$(".delete").click(function(){
		var row =  $(this).closest("tr");
		var date = row.find(".date").text();
		var time = row.find(".time").text();
		var xhttp;
		if (window.XMLHttpRequest) {
    		xhttp = new XMLHttpRequest();
    	}else
		{
   			xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xhttp.onreadystatechange = function() {
			if(xhttp.readyState==4 && xhttp.status==200){
				row.remove();
			}
		};
		xhttp.open("POST","../admin-tasks/admin-delete-appointment.php",true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("date="+ String(date)+ "&hour="+String(time));
	});
});
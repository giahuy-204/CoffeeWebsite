<?php

session_start();

require_once ("php/connect_menu.php");
require_once ("php/component.php");

$db = new CreateDb("3855137_hyu1", "producttb");

if (!isset($_SESSION['cart'])){
	header("location: menu.php");
	exit;
}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Coffee Order Form</title>
	<link rel="stylesheet" type="text/css" href="orderStyle.css">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="order_form_style.css">
</head>
<body>

	<img src="upload/download.png" class="logo">

	<h3>HoHuTa coffee shop</h3>
	<h4>Online Order Form</h4>

	<form method="POST" action="order_set.php" onsubmit="return timeCheck(event)">
		
		<table align="center" cellpadding="5">
			<tr>
				<td>
					<!-- Name -->
					<p>
						<label>*Name: </label>
						<input type="text" name="name" id="name" required>
					</p>

					<!-- Email -->
					<p>
						<label>*Email: </label>
						<input type="email" name="email" id="email" required>
					</p>

				</td>
				<td colspan="2">
					<!-- Telephone -->
					<p>
						<label>*Phone: </label>
						<input type="text" name="tel" id="tel" required>
					</p>

					<!-- Address -->
					<p>
						<label>*Address: </label>
						<input type="text" name="address" id="address" required>
					</p>	

				</td>
			</tr>
			

			<!-- Delivery Time -->
			<tr>
				<td>
					<label>Preferred Delivery Time: </label>
				</td>
				<td colspan="2">
					<input type="time" name="delivery_time" id="delivery_time" min='07:00' max= '21:00' required>
				</td>
			</tr>

			<!-- Note for items -->
			<tr>
				<td>
					<label>Note For Items: </label>
				</td>
				<td colspan="2">
					<textarea rows="5" cols="30" name="instuctions" id="instuctions"></textarea>
				</td>
			</tr>

			<!-- Submit Button -->
			<tr>
				<td colspan="3" align="center">
					<button type="submit" name="submit" id="submit">Submit Order</button>
				</td>
			</tr>

		</table>
	</form>
	<div class="footer-basic">
        <footer>
            <p class="copyright">HoHuTa coffee shop © 2018</p>
        </footer>
    </div>

	<script>
		function timeCheck(event){
			var element = document.getElementById("delivery_time").value;
  
			if (element == "") {
			alert("Please Enter Time");
				return false;  
			}
			else {
			
			// get system local time
			var d = new Date();
			var m = d.getMinutes();
			var h = d.getHours();
			if(h == '0') {h = 24}
			
			var currentTime = h+"."+m;
			console.log(currentTime);
			
			// get input time
			var time = element.split(":");
			var hour = time[0];
			if(hour == '00') {hour = 24}
			var min = time[1];
			
			var inputTime = hour+"."+min;
			console.log(inputTime);
			
			var totalTime = inputTime - currentTime;
			console.log(totalTime);
			
			if (totalTime < 0.5) {
				alert("Please input valid time longer than 30 minutes!")
				event.preventDefault();
			} 
    	}
	}
	</script>
</body>
</html>
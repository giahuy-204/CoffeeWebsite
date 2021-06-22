<?php

session_start();

require_once ("php/connect_menu.php");
require_once ("php/order_component.php");

$db = new CreateDb("3855137_hyu1", "producttb");

if (!isset($_SESSION['cart'])){
	header("location: menu.php");
	exit;
}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Coffee Order Form</title>
	<link rel="stylesheet" type="text/css" href="orderStyle.css">
</head>
<body>

	<img src="download.png" class="logo">

	<h3>HoHuTa coffee shop</h3>
	<h4>Online Order Form</h4>

	<form method="POST" action="order_set.php">
		
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

					<!-- Address -->
					<p>
						<label>*Address: </label>
						<input type="text" name="address" id="address" required>
					</p>	
				</td>
				<td colspan="2">
					<!-- Telephone -->
					<p>
						<label>*Phone: </label>
						<input type="text" name="tel" id="tel" required>
					</p>

					<!-- City -->
					<p>
						<label>*City: </label>
						<input type="text" name="city" id="city" required>
					</p>

					<!-- District -->
					<p>
						<label>*District: </label>
						<input type="text" name="dis" id="dis" required>
					</p>
				</td>
			</tr>
			

			<!-- Delivery Time -->
			<tr>
				<td>
					<label>Preferred Delivery Time: </label>
				</td>
				<td colspan="2">
					<input type="time" name="delivery_time" id="delivery_time" required>
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

</body>
</html>
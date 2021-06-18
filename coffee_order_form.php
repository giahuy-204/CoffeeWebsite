<!DOCTYPE html>
<html>
<head>
	<title>Ordering Coffee</title>
	<link rel="stylesheet" type="text/css" href="orderStyle.css">
</head>
<body>

	<img src="https://cfcdn.zulily.com/images/cache/product/1000x1201/179020/zu36820250_main_tm1458056412.jpg" width="98%" height="500px" />

	<h3>HoHuTa coffee shop</h3>
	<h4>Online Order Form</h4>

	<!-- Pizza Delivery Form -->
	<form method="POST" action="order_set.php">
		
		<!-- Data inside table -->
		<table align="center" cellpadding="5">
			<tr>
				<td>
					<!-- Name -->
					<p>
						<label>*Name: </label>
						<input type="text" name="name" id="name">
					</p>

					<!-- Email -->
					<p>
						<label>*Email: </label>
						<input type="email" name="email" id="email">
					</p>

					<!-- Address -->
					<p>
						<label>*Address: </label>
						<input type="text" name="address" id="address">
					</p>	
				</td>
				<td colspan="2">
					<!-- Telephone -->
					<p>
						<label>*Phone: </label>
						<input type="text" name="tel" id="tel">
					</p>

					<!-- City -->
					<p>
						<label>*City: </label>
						<input type="text" name="city" id="city">
					</p>

					<!-- District -->
					<p>
						<label>*District: </label>
						<input type="text" name="dis" id="dis">
					</p>
				</td>
			</tr>
			

			<!-- Delivery Time -->
			<tr>
				<td>
					<label>Preffered Delivery Time: </label>
				</td>
				<td colspan="2">
					<input type="time" name="delivery_time" id="delivery_time">
				</td>
			</tr>

			<!-- Delivery Instruction -->
			<tr>
				<td>
					<label>Delivery Instructions: </label>
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

			<div>

				<form method="get" action="login.html">
					<button style="margin-left:auto;margin-right:auto;display:block;margin-top:-3%;padding: 10px;" type="submit" id="get_started">Get started</button>
				</form>

    		</div>

		</table>
	</form>

</body>
</html>
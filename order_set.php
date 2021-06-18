<!DOCTYPE html>
<html>
<head>
	<title>Order Set</title>
	<style type="text/css">
		td { padding: 40px; }
	</style>
</head>
<body>

	
<?php 

	// check for submit button 
	if (isset($_POST['submit'])) {
		echo "<p>Dear <strong>" . $_POST['name'] . "</strong>, your order has been set.";
			echo "<br> We well contact you soon.";
		echo "</p>";
	}
	

	echo "<br>";

?>

<!-- Footer -->
<footer>
	<p>
		<address>
			<p><strong>Address#1: </strong> 158A Le Loi, Hai Chau 1, Hai Chau, Da Nang, Viet Nam </p>
			<p><strong>Address#2: </strong> 16 Tran Phu, Thach Thang, Hai Chau, Da Nang, Viet Nam</p>
			<p><strong>Phone: </strong> 0905397882</p>
			<p><strong>Email us: </strong> <a href="mailto:tai.hoan.huy196969@life.edu.vn">tai.hoan.huy196969@life.edu.vn</a></p>
		</address>
	</p>

	

</footer>

			<div>

				<form method="get" action="index.html">
					<button  type="submit" id="get_started">Back to HomePage</button>
				</form>

    		</div>

</body>
</html>

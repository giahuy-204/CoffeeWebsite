<?php

session_start();

require_once ("php/CreateDb.php");
require_once ("php/order_component.php");

$db = new CreateDb("3855137_hyu1", "producttb");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Set</title>
	<style type="text/css">
		td { padding: 40px; }
	</style>
	<meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
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


	$total = 0;
	if (isset($_SESSION['cart'])){
		$product_id = array_column($_SESSION['cart'], 'product_id');

		$result = $db->getData();
		while ($row = mysqli_fetch_assoc($result)){
			foreach ($product_id as $id){
				if ($row['id'] == $id){
					cartElement($row['product_image'], $row['product_name'],$row['product_price'], $row['id']);
					$total = $total + (int)$row['product_price'];
				}
			}
		}
	}
?>


<script type="text/javascript">
    document.getElementById("get_started").addEventListener("click", function() {
		<?php
		foreach ($_SESSION['cart'] as $key => $value){
			unset($_SESSION['cart'][$key]);
    };
	?>
</script>

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

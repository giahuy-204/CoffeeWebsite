<?php

	session_start();

	require_once ("php/connect_menu.php");
	require_once ("php/order_component.php");
	require_once ("order/connect_order.php");

	$db = new CreateDb("3855137_hyu1", "producttb");

	if (!isset($_SESSION['cart'])){
		header("location: menu.php");
		exit;
	}
	
	$delete_order = "DELETE FROM ordertb WHERE ts_created < DATE_ADD(NOW(),INTERVAL -24 HOUR)"; 

	if(mysqli_query($link, $delete_order)){
		//  echo "DEBUGGING";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}

	$order_id = rand(100000,999999);
	$customer_name = $_POST['name'];
	$time = $_POST['delivery_time'];
	$note = $_POST['instuctions'];
	$address = $_POST['address'];
	$phone = $_POST['tel'];
	$productArr = [];

	if(isset($_POST['submit'])){
		if(isset($_SESSION['cart'])){
			$product_id = array_column($_SESSION['cart'], 'product_id');

			$result = $db->getData();
			while ($row = mysqli_fetch_assoc($result)){
				foreach ($product_id as $id){
					if ($row['id'] == $id){
						$product_name = $row['product_name'];
						array_push($productArr, $product_name);
					}
				}	
			}
			$product_array = implode(", ",$productArr);
			$sql = "INSERT INTO ordertb (order_id, name, order_time, note, customer_name, delivery_address, customer_phone) 
			VALUES ('$order_id', '$product_array', '$time', '$note', '$customer_name', '$address', '$phone')"; 
			if(mysqli_query($link, $sql)){
				//  echo "DEBUGGING";
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
			// echo "<script>console.log('Debug Objects: " . implode(" ",$myArr) . "' );</script>";
		}
	}
	mysqli_close($link);
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

    <link rel="stylesheet" href="menustyle.css">
</head>
<body>


<?php 
	// check for submit button 
	if (isset($_POST['submit'])) {
		echo "<p>Dear <strong>" . $_POST['name'] . "</strong>, your order has been set.";
		echo "<br> Your order ID is: <strong>" . $order_id . "</strong>.";
		echo "<br> We will contact you soon.";
	}
	echo "<br>";

	echo "<h3 style='text-align:center'>Order Information</h3>";

	echo "<br>";

	if (isset($_SESSION['cart'])){
		$product_id = array_column($_SESSION['cart'], 'product_id');

		$result = $db->getData();
		while ($row = mysqli_fetch_assoc($result)){
			foreach ($product_id as $id){
				if ($row['id'] == $id){
					cartElement($row['product_image'], $row['product_name'],$row['product_price'], $row['id']);
				}
			}
		}
	}

	if (empty($note)) {
		echo "<p>No note received.";
	} else {
		echo "<p>Note: " . $note . ".";
	}
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
	<form method="post" action="index.html">
		<input style="margin-left:auto;margin-right:auto;display:block;" type="submit" id="submit" name = "submit" value ="Submit order and back to HomePage"></input>
	</form>
</footer>

<div class="footer-basic">
    <footer>
        <p class="copyright">HoHuTa coffee shop © 2018</p>
    </footer>
</div>
			
</body>

<script type="text/javascript">
    document.getElementById("get_started").addEventListener("click", function() {
		<?php
		foreach ($_SESSION['cart'] as $key => $value){
			unset($_SESSION['cart'][$key]);
			unset($note);
    	}
		?>
</script>

</html>

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

require_once ("php/CreateDb.php");
require_once ("php/component.php");

$db = new CreateDb("3855137_hyu1", "producttb");

	// check for submit button 
	if (isset($_POST['submit'])) {
		echo "<p>Dear <strong>" . $_POST['name'] . "</strong>, your order has been set.";
			echo "<br> We well contact you soon.";
		echo "</p>";
		
		foreach ($_SESSION['cart'] as $key => $value){
			unset($_SESSION['cart'][$key]);          
		}
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
}else{
	echo "<h5>Cart is Empty</h5>";
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

	

</footer>

			<div>

				<form method="get" action="index.html">
					<button  type="submit" id="get_started">Back to HomePage</button>
				</form>

    		</div>

</body>
</html>

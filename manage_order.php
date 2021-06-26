<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo "<script>alert('Please login to use this function!')</script>";
    echo "<script>window.location = 'login.php'</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>Manage</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="manage_style.css">

<script type="text/javascript">
    $(document).ready(function(){
        // $('#manage_table').DataTable({
        //     "pagingType": "full_numbers"
        // }); 

        // var order_table = $('#manage_table').DataTable( {
        //     rowReorder: {
        //     selector: 'td:nth-child(2)'
        //     },
        //     responsive: true
        // } );
 
        // new $.fn.dataTable.FixedHeader(order_table);

        var actions = $("table td:last-child").html();
        
        // Delete row on delete button click
        $(document).on("click", ".delete", function(){
                
            $(this).parents("tr").remove();
            $(".add-new").removeAttr("disabled");
            var id = $(this).attr("id");
            var string = id;
            $.post("order_delete.php", { string: string}, function(data) {
                $("#displaymessage").html(data);
            });
            alert('Order has been removed!'); 
            window.location = 'manage_order.php';
        }); 
    });
</script> 
</head>
<body>
    <img id="thumbnail" src="https://i.imgur.com/QHMQohI.jpg?1" alt="thumbnail">
    <div class="class_container">
        <div class="nav-toggle" id="navToggle">
            <img id="navClosed" class="navIcon" src="https://www.richardmiddleton.me/wp-content/themes/richardcodes/assets/img/hamburger.svg" alt="nav closed">
            <img id="navOpen" class="navIcon hidden" src="https://www.richardmiddleton.me/wp-content/themes/richardcodes/assets/img/close.svg" alt="nav open">
        </div>
        <nav>
            <ul>
                <li>
                    <a href="index.html"><i class="fa fa-fw fa-home"></i>Homepage</a>
                </li>
                <li>
                    <a href="menu.php"><i class="fa fa-fw fa-coffee"></i>Menu</a>
                </li>
                <li>
                    <a href="Aboutus.html"><i class="fa fa-fw fa-envelope"></i>About us</a>
                </li>
                <li>
                    <a href="Contactus.html"><i class="fa fa-fw fa-user"></i>Contact us</a>
                </li>
                <li >
                    <a href="manage.php"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Manage Product</a>
                </li>
                <li class="active-page">
                    <a href="manage_order.php"><i class="fa fa-first-order" aria-hidden="true"></i> Manage Order</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container"><p><h1 align="center">Manage order</h1><div id="displaymessage"></div></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Order <b>Details</b></h2></div>
                </div>
            </div>
    <table class="table table-bordered" id = "manage_table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer name</th>
                    <th>Customer number</th>
                    <th>Product ordered</th>
                    <th>Delivery time</th>
                    <th>Delivery address</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
        <?php 
            include "connect_manage.php"; 
            $query_pag_data = "SELECT * from ordertb ORDER BY order_time ASC";
            $result_pag_data = mysqli_query($conn, $query_pag_data);
            while($row = mysqli_fetch_assoc($result_pag_data)) {
                $id=$row['id']; 
                $orderid = $row['order_id'];
                $productname=$row['name']; 
                $customername=$row['customer_name'];
                $customernumber=$row['customer_phone'];
                $deliveryaddress = $row['delivery_address'];
                $deliverytime=$row['order_time']; 
                $productnote=$row['note']; 
        ?>
                <tr>
                    <td><?php echo $orderid; ?></td>
                    <td><?php echo $customername; ?></td>
                    <td><?php echo $customernumber; ?></td>
                    <td><?php echo $productname; ?></td>
                    <td><?php echo $deliverytime; ?></td>
                    <td><?php echo $deliveryaddress; ?></td>
                    <td><?php echo $productnote; ?></td>
                    <td>
                        <a class="delete" title="Delete" data-toggle="tooltip" id="<?php echo $id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                </tr>   
        <?php } ?>     
            </tbody>
        </table>
    </div>
</div>   
<div class="footer-basic">
    <footer>
        <p class="copyright">HoHuTa coffee shop © 2018</p>
    </footer>
</div>  

    <script src="main.js"></script>

</body>
</html> 
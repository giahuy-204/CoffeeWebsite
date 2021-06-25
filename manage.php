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

        var actions = $("table td:last-child").html();
        // Append table with add row form on add new button click
        $(".add-new").click(function(){
            $(this).attr("disabled", "disabled");
            var index = $("table tbody tr:last-child").index();
            var row = '<tr>' +
            '<td><input type="text" class="form-control" name="name" id="product_name"></td>' +
            '<td><input type="text" class="form-control" name="product_price" id="product_price"></td>' +
            '<td><input type="text" class="form-control" name="product_description" id="product_description"></td>' +
            '<td><input type="text" class="form-control" name="product_image" id="product_image"></td>' +
            '<td>' + actions + '</td>' +
            '</tr>';
            $("table").append(row);  
            $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
            $('[data-toggle="tooltip"]').tooltip();
        });
  
        // Add row on add button click
        $(document).on("click", ".add", function(){
            var empty = false;
            var input = $(this).parents("tr").find('input[type="text"]');
            input.each(function(){
                if(!$(this).val()){
                    $(this).addClass("error");
                    empty = true;
                }else{
                    $(this).removeClass("error");
                }
            });
            var product_name = $("#product_name").val();
            var product_price = $("#product_price").val();
            var product_description = $("#product_description").val();
            var product_image = $("#product_image").val();
            $.post("menu_add.php", { product_name: product_name, product_price: product_price, product_description: product_description, product_image: product_image}, function(data) {
                $("#displaymessage").html(data);
            });
            $(this).parents("tr").find(".error").first().focus();
            if(!empty){
                alert('Product has been added!'); 
                window.location = 'manage.php';
                input.each(function(){
                $(this).parent("td").html($(this).val());
            });   
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").removeAttr("disabled");
            } 
        });
        // Delete row on delete button click
        $(document).on("click", ".delete", function(){
            $(this).parents("tr").remove();
            $(".add-new").removeAttr("disabled");
            var id = $(this).attr("id");
            var string = id;
            $.post("menu_delete.php", { string: string}, function(data) {
                $("#displaymessage").html(data);
            });
            alert('Product has been removed!'); 
            window.location = 'manage.php';
        }); 
        // update rec row on edit button click
        $(document).on("click", ".update", function(){
            var id = $(this).attr("id");
            var string = id;
            var product_name = $("#product_name").val();
            var product_price = $("#product_price").val();
            var product_description = $("#product_description").val();
            var product_image = $("#product_image").val();
            $.post("menu_update.php", { string: string,product_name: product_name, product_price: product_price, product_description: product_description, product_image: product_image}, function(data) {
                $("#displaymessage").html(data);
            });
            alert('Product has been updated!'); 
            window.location = 'manage.php';
        });
        // Edit row on edit button click
        $(document).on("click", ".edit", function(){  
            $(this).parents("tr").find("td:not(:last-child)").each(function(i){
                if (i=='0'){
                    var idname = 'product_name';
                }else if (i=='1'){
                    var idname = 'product_price';
                }else if (i=='2'){
                    var idname = 'product_description';
                }else if (i=='3'){
                    var idname = 'product_image';
                }else{} 
                $(this).html('<input type="text" name="updaterec" id="' + idname + '" class="form-control" value="' + $(this).text() + '">');
            });  
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").attr("disabled", "disabled");
            $(this).parents("tr").find(".add").removeClass("add").addClass("update");
            // alert('Product has been adjusted!'); 
            // window.location = 'manage.php';
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
                <li class="active-page">
                    <a href="manage.php"><i class="fa fa-cloud-upload"></i> Manage Product</a>
                </li>
                <li>
                    <a href="manage_order.php"><i class="fa fa-first-order"></i> Manage Order</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container"><p><h1 align="center">Manage menu</h1><div id="displaymessage"></div></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Menu <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add new product</button>
                    </div>
                </div>
            </div>
    <table class="table table-bordered" id = "manage_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        <?php 
            include "connect_manage.php"; 
            $query_pag_data = "SELECT * from producttb";
            $result_pag_data = mysqli_query($conn, $query_pag_data);
            while($row = mysqli_fetch_assoc($result_pag_data)) {
                $id=$row['id']; 
                $productname=$row['product_name']; 
                $productprice=$row['product_price'];
                $productdescription = $row['product_description']; 
                $productimage=$row['product_image']; 
        ?>
                <tr>
                    <td><?php echo $productname; ?></td>
                    <td><?php echo $productprice; ?></td>
                    <td><?php echo $productdescription; ?></td>
                    <td><?php echo $productimage; ?></td>
                    <td>
                        <a class="add" title="Add" data-toggle="tooltip" id="<?php echo $id; ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                        <a class="edit" title="Edit" data-toggle="tooltip" id="<?php echo $id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    echo '<script>alert("Please login to use this function")</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manage</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    body {
        color: #404E67;
        background: #F5F7FA;
        font-family: 'Open Sans', sans-serif;
    }
    .table-wrapper {
        width: 700px;
        margin: 30px auto;
        background: #fff;
        padding: 20px; 
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
        float: right;
        height: 30px;
        font-weight: bold;
        font-size: 12px;
        text-shadow: none;
        min-width: 100px;
        border-radius: 50px;
        line-height: 13px;
    }
    .table-title .add-new i {
        margin-right: 4px;
    }
    table.table {
        table-layout: fixed;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
        cursor: pointer;
        display: inline-block;
        margin: 0 5px;
        min-width: 24px;
    }   
    table.table td a.add {
        color: #27C46B;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
    table.table td a.add i {
        font-size: 24px;
        margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
    table.table .form-control.error {
        border-color: #f50000;
    }
    table.table td .add {
        display: none;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        var actions = $("table td:last-child").html();
        // Append table with add row form on add new button click
        $(".add-new").click(function(){
            $(this).attr("disabled", "disabled");
            var index = $("table tbody tr:last-child").index();
            var row = '<tr>' +
            '<td><input type="text" class="form-control" name="name" id="product_name"></td>' +
            '<td><input type="text" class="form-control" name="product_price" id="product_price"></td>' +
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
            var product_image = $("#product_image").val();
            $.post("ajax_add.php", { product_name: product_name, product_price: product_price, product_image: product_image}, function(data) {
                $("#displaymessage").html(data);
            });
            $(this).parents("tr").find(".error").first().focus();
            if(!empty){
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
            $.post("ajax_delete.php", { string: string}, function(data) {
                $("#displaymessage").html(data);
            });
        });
        // update rec row on edit button click
        $(document).on("click", ".update", function(){
            var id = $(this).attr("id");
            var string = id;
            var product_name = $("#product_name").val();
            var product_price = $("#product_price").val();
            var product_image = $("#product_image").val();
            $.post("ajax_update.php", { string: string,product_name: product_name, product_price: product_price, product_image: product_image}, function(data) {
                $("#displaymessage").html(data);
            });
        });
        // Edit row on edit button click
        $(document).on("click", ".edit", function(){  
            $(this).parents("tr").find("td:not(:last-child)").each(function(i){
                if (i=='0'){
                    var idname = 'product_name';
                }else if (i=='1'){
                    var idname = 'product_price';
                }else if (i=='2'){
                    var idname = 'product_image';
                }else{} 
                $(this).html('<input type="text" name="updaterec" id="' + idname + '" class="form-control" value="' + $(this).text() + '">');
            });  
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").attr("disabled", "disabled");
            $(this).parents("tr").find(".add").removeClass("add").addClass("update");
        });
    });
</script> 
</head>
<body>
    <div class="container"><p><h1 align="center">Manage menu</h1><div id="displaymessage"></div></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Menu <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                </div>
            </div>
    <table class="table table-bordered" id = "manage_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
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
                $productimage=$row['product_image']; 
        ?>
                <tr>
                    <td><?php echo $productname; ?></td>
                    <td><?php echo $productprice; ?></td>
                    <td><?php echo $productimage; ?></td>
                    <td>
                        <a class="add" title="Add" data-toggle="tooltip" id="<?php echo $id; ?>"><i class="fa fa-user-plus"></i></a>
                        <a class="edit" title="Edit" data-toggle="tooltip" id="<?php echo $id; ?>"><i class="fa fa-pencil"></i></a>
                        <a class="delete" title="Delete" data-toggle="tooltip" id="<?php echo $id; ?>"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>   
        <?php } ?>     
            </tbody>
        </table>
    </div>
</div>     
</body>
</html> 
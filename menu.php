<?php

session_start();

require_once ('php/connect_menu.php');
require_once ('php/component.php');

$database = new CreateDb("3855137_hyu1", "producttb");

if (isset($_POST['add'])){
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        $_SESSION['cart'][0] = $item_array;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Coffee Menu</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="menustyle.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap" rel="stylesheet">
</head>
<body style="background-color:#af7c35">

<img id="thumbnail" src="https://i.imgur.com/QHMQohI.jpg?1" alt = "thumbnail">
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
                <li class="active-page">
                    <a href ="menu.php"><i class="fa fa-fw fa-coffee"></i>Menu</a>
                </li>
                <li>
                    <a href="Aboutus.html"><i class="fa fa-fw fa-envelope"></i>About us</a>
                </li>
                <li>
                    <a href="Contactus.html"><i class="fa fa-fw fa-user"></i>Contact us</a>
                </li>
                <li>
                    <a href="manage.php"><i class="fa fa-cloud-upload" aria-hidden="true"></i>Manage Product</a>
                </li>
                <li>
                    <a href="manage_order.php"><i class="fa fa-first-order"></i> Manage Order</a>
                </li>
            </ul>
        </nav>
    </div>

<?php require_once ("php/header.php"); ?>
<div class="container">
        <div class="row text-center py-5">
            <?php
                $result = $database->getData();
                while ($row = mysqli_fetch_assoc($result)){
                    component($row['product_name'], $row['product_price'],  $row['product_description'], $row['product_image'], $row['id']);
                }
            ?>
        </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="main.js"></script>

<div class="footer-basic">
        <footer>
            <p class="copyright">HoHuTa coffee shop © 2018</p>
        </footer>
</div>
</body>
</html>
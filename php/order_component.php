<?php
function cartElement($productimg, $productname, $productprice, $productid){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: HoHuTa Coffee Shop</small>
                                <h5 class=\"pt-2\">$$productprice</h5>
                            </div>
                            <div class=\"col-md-3 py-5\">
                               
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}


















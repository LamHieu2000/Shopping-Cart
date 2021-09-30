<?php

function component($productName, $productPrice, $productImg, $productID){
    $element ="
    <div class=\"col-md-3 col-sm-6 my-md-3\">
                <form action=\"index.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$productImg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productName</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <p class=\"card-text\">
                                Sản phẩm chất lượng cao
                            </p>
                            <h5>
                                <small><s class=\"text-sec\">450đ</s></small>
                                <span class=\"price\">$productPrice</span>
                            </h5>                        
                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                            <input type='hidden' name='product_ID' value='$productID'>           
                        </div>
                    </div>                  
                </form>
            </div>
    ";
    echo $element;
    
}
// \"cart.php?action=remove&id=$productID\" xác nhận có muốn xóa mặt hàng khỏi giỏ hàng hay không

// <!-- san pham - thong tin ... san pham -->
// <div class=\"col-md-6\">
// <h5 class=\"pt-2\">$productName</h5>

// <!-- them - giam so luong san pham trong gio hang -->
// <div class=\"col-md-3 py-5\">
// <div>
// <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
function cartElement($productImg, $productName, $productPrice, $productID){
    $element ="
    
    <form action=\"cart.php?action=remove&id=$productID\" method=\"post\" class=\"cart-items\">
    <div class=\"border rounded\">
        <div class=\"row bg-white\">
             <div class=\"col-md-3 pl-0\">
                 <img src=$productImg alt=\"Image1\" class=\"img-fluid\">
             </div>
            
          
             <div class=\"col-md-6\">
                 <h5 class=\"pt-2\">$productName</h5>
                    <small class=\"text-secondary\">Seller: Giá ưu đãi cho sinh viên!</small>
                    <h5 class=\"pt-2\">$productPrice</h5>
                    <button type=\"submit\" class=\"btn btn-warning\">Lưu sau</button>
                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Xóa</button>
                </div>
               
             <div class=\"col-md-3 py-5\">
                    <div>
                        <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                        <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                        <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                    </div>
             </div>
        </div>
    </div>
</form>
    ";
}
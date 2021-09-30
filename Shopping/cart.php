<?php
    session_start();
    require_once("php/CreateDatabase.php");
    require_once("php/component.php");
    $db = new CreateDatabase("Productdb", "Producttb");
    
    //xóa sp khỏi giỏ và trả về id của sp đó
    if(isset($_POST['remove']))
    {
       // print_r($_GET['id']);
       if($_GET['action'] == 'remove'){
           foreach($_SESSION['cart'] as $key => $value){
               if($value['product_id'] == $_GET['id'])
                {
                    unset($_SESSION['cart'][$key]);
                    echo "<script>alert('Sản phẩm đã được xóa...')</script>";
                    echo "<script>windown.location = 'cart.php'</script>";
                }
           }
       }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <?php
        require_once('php/headerCart.php')
    ?>
    <!-- tao chu nang xem gio hang va cac thong tin san pham :v -->
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <!-- dung trong bootstrap -->
                <div class="shopping-cart">
                    <h5>My Cart</h5>
                    <hr>

                    <?php 
                        $total= 0; //tính tổng các mặt hàng có trong cart
                        if(isset($_SESSION['cart'])){
                        $product_ID = array_column($_SESSION['cart'],'product_ID'); 
                        $result = $db->getData();
                        while($row = mysqli_fetch_assoc($result)){
                            // lay tat sp trong database
                            //hien thi tat ca san pham co trong gio hang
                            foreach($product_ID as $id){
                                if($row['id'] == $id){
                                    //in tt sp trong gio hang = cach goi ham cartElement
                                    cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);                                    
                                    $total = $total + (int)$row['product_price'];
                                }

                            }
                        }
                            
                        }else{
                              echo '<h5>Vỏ hàng trống!!!</h5>';
                        }

                    ?>
<!--san pham - thong tin ... san pham
                    <form action="cart.php" method="get" class="cart-items">
                        <div class="border rounded">
                            <div class="row bg-white">
                                 <div class="col-md-3 pl-0">
                                     <img src="./Upload/product1.jpg" alt="Image1" class="img-fluid">
                                 </div>
                                  san pham - thong tin ... san pham -->
<!--them - giam so luong san pham trong gio hang 
                                 <div class="col-md-6">
                                     <h5 class="pt-2">Product1</h5>
                                        <small class="text-secondary">Seller: Giá ưu đãi cho sinh viên!</small>
                                        <h5 class="pt-2">600đ</h5>
                                        <button type="submit" class="btn btn-warning">Lưu sau</button>
                                        <button type="submit" class="btn btn-danger mx-2" name="remove">Xóa</button>
                                    </div>
                                    them - giam so luong san pham trong gio hang 
                                 <div class="col-md-3 py-5">
                                        <div>
                                            <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-minus"></i></button>
                                            <input type="text" value="1" class="form-control w-25 d-inline">
                                            <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-plus"></i></button>
                                        </div>
                                 </div>
                            </div>
                        </div>
                    </form>
                -->
                </div>
            </div>

            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-26">
                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>   
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if(isset($_SESSION['cart'])){
                                $count = count($_SESSION['cart']);
                                echo'<h6>Price($count items)</h6>';
                                
                            }else{
                                echo'<h6>Price(0 items)</h6>';
                            }
                            ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>
                                <?php
                                    echo $total; //tổng giá các sp có trong giỏ hàng
                                ?> VND
                                <h6 class="text-sucess">FREE</h6>
                                <hr>
                                <h6><?php
                                    echo $total;
                                ?> VND</h6>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
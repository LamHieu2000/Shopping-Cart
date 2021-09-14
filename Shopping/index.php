<?php

//tao chu nang them sp vao gio hang
    session_start();

    require_once('php/CreateDatabase.php');
    require_once('./php/component.php');

//tao instance của CreateDatabase class
    $database = new CreateDatabase("Productdb","Producttb");
//tao csdl moi voi ten productdb

    if(isset($_POST['add'])){
        //print_r($_POST['product_ID']);
        //add sp vao gio hang dua tren id_sp
        if(isset($_SESSION['cart'])){
            //kiem tra sp co trong gio hang chua, neu chua thi => xac nhan
            //them vao gio hang
            $item_array_id = array_column($_SESSION['cart'],"product_ID");
            print_r($item_array_id);

            if(in_array($_POST['product_ID'], $item_array_id)){//neu id sp da co trong gio hang
            //
                echo "<script>alert('Sản phẩm này đã có trong giỏ hàng')</script>";
                echo "<script>window.location = 'index.php'</script>";
            
            }else{//sp chua co thi them vao gio hang

                $count = count($_SESSION['cart']);
                $item_array = array(
                    'product_ID' => $_POST['product_ID']
                );

                $_SESSION['cart'][$count] = $item_array;
                
            }
        }else{
            $item_array = array(
                'product_ID' => $_POST['product_ID']
            );

            //tao mang tam luu sp vao gio hang (id sp)
            $_SESSION['cart'][0] = $item_array;
            print_r(($_SESSION['cart']));

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEGERY</title>
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>  

    <!-- link qua thanh header -->
    <?php require_once("php/headerCart.php"); ?>

    <div class="container">
        <div class="row text-center py-5">
            <?php 
                $result = $database->getData();
                while($row = mysqli_fetch_assoc($result)){
                    //mang ket hop, lay du lieu cac dong trong bang
                    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
        
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
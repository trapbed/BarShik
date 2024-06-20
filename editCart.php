<?php
session_start();
    require_once "connect-db.php";
    
    $act = isset($_GET["act"]) ? $_GET["act"] : false;
    $product = isset($_GET["product"]) ? $_GET["product"] : false;
    if($act && $product){
        $cart = mysqli_fetch_array(mysqli_query($con,"SELECT into_cart FROM cart WHERE id_user = ".$_SESSION['id_user']))['into_cart'];
        // print_r($cart);
        $newCart = [];
        $cart = (array) json_decode($cart);
        foreach($cart as $prod => $amount){
            if($prod == $product){
                // echo "true";
                if($act == 'minus'){
                    if($amount == 1){
                        unset($newCart["$prod"]);
                    }
                    else{
                        $newCart["$prod"] = $amount-1;
                    }
                }
                else{
                    $newCart["$prod"] = $amount+1;
                }
            }
            else{
                // echo "false";
                $newCart["$prod"] = $amount;
            }
            // $newCart = array_push($newCart, $newCart["$prod"]);
            // $newCart = array_merge($newCart, $cart);
                // echo $prod, $amount;
                // echo "<br>";
        }
        print_r($newCart);
        $newCart = json_encode($newCart);
        print_r($newCart);
        $query = mysqli_query($con,"UPDATE `cart` SET `into_cart` = '$newCart' WHERE `cart`.`id_user` =".$_SESSION['id_user']);
        if($query){
            // $_SESSION['mess'] = "Корзина изменена!";
            header("Location: account.php?page=cart");
        }
        else{
            // $_SESSION['mess'] = "Не удалось изменить корзину!";
            header("Location: account.php?page=cart");
        }
        // echo "UPDATE `cart` SET `into_cart` = '$newCart' WHERE `cart`.`id_user` =".$_SESSION['id_user'];
    }
    else{
        $_SESSION['mess'] = "Что то пошло не так!";
        header("Location: account.php?page=cart");
    }
?>
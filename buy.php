<?php
    session_start();
    require_once "connect-db.php";

    $id_user = $_SESSION['id_user'];
    $num_row_cart = mysqli_num_rows(mysqli_query($con, "SELECT into_cart FROM cart WHERE id_user = ".$_SESSION['id_user']));
    if($num_row_cart != 0){
        $cart = mysqli_fetch_array(mysqli_query($con,"SELECT into_cart FROM cart WHERE id_user = ".$_SESSION['id_user']))['into_cart'];
        $cart = (array) json_decode($cart);
        $sumCart = 0;
        foreach($cart as $prod => $amount){
            $info_prod = mysqli_fetch_array(mysqli_query($con, "SELECT products.name_product, products.image_product, volumes.volume_of_prod, volumes.price_volume FROM volumes JOIN products ON products.id_product = volumes.id_product WHERE volumes.id_volume_prod = $prod"));
            $sumCart += $info_prod[3] * $amount;
        }
        $bonuses = $sumCart * 5/100;
        $query = "INSERT INTO `orders` (`id_user`, `date_order`, `status_order`, `sum_order`, `bonus_minus`, `bonus_plus`)
        VALUES ($id_user, CURRENT_TIMESTAMP, '1', '$sumCart', '0', '$bonuses');";
        echo $query;
        $result = mysqli_query($con, $query);
        if($query){
            $id_order = mysqli_insert_id($con);
            foreach ($cart as $prod => $amount){
                $row_query = "INSERT INTO order_row (id_order, id_product, amount_products) VALUES ($id_order, $prod, $amount);";
                $row_res = mysqli_query($con, $row_query);
            }
            $del = mysqli_query($con,"DELETE FROM cart WHERE `cart`.`id_user` =".$id_user);
            $_SESSION['mess'] = "Успешное офрмление заказа!";
            header("Location: ../account.php?page=cart");
        }
        else{
            $_SESSION['mess'] = "Не удалось совершить заказ!";
            header("Location: ../account.php?page=cart");
        }
    }
    else{
        $_SESSION['mess'] = "Нет товаров для бронирования!";
        header("Location: ../account.php?page=cart");
    }
    // echo $bonuses;
    // echo $sumCart;
?>
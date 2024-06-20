<?php
require_once "connect-db.php";
session_start();
// print_r($_POST);
$vol_row =  $_POST['vol_row']   != "" ? $_POST['vol_row'] : false;
$id_user =  isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;
$prod =     $_POST['prod']      != "" ? $_POST['prod'] : false;
$cat =      $_POST['category']  != "" ? $_POST['category'] : false;
$numProd =  isset($_POST['numProd']) ? $_POST['numProd'] : false;

if(!$id_user){
    $_SESSION['mess'] = "Для начала авторизуйтесь в системе!";
    header("Location: ../catalog.php?category=$cat&id=$prod&numProd=$numProd");
}
else if(!$vol_row){
    $_SESSION['mess'] = "Выберите объем!";
    header("Location: ../catalog.php?category=$cat&id=$prod&numProd=$numProd");
}
else{
    $cart = mysqli_fetch_assoc(mysqli_query($con, "SELECT into_cart from cart where id_user = $id_user"));

    if (is_null($cart)) {
        $into_cart[$vol_row] = 1;
        $into_cart = json_encode($into_cart);
        $sql = "INSERT INTO `cart`(`id_user`, `into_cart`) VALUES ($id_user , '$into_cart')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            // $_SESSION["cart"] = mysqli_fetch_assoc(mysqli_query($con, "SELECT into_cart from cart where id_user = '$id_user'"))['into_cart'];
        // echo "SELECT into_cart from cart where id_user = '$id_user'";
            $_SESSION['mess'] = "Товар в корзине!";
            echo "<script>
                    location.href = 'catalog.php?category=$cat&id=$prod&numProd=$numProd&volume_row=$vol_row';
                </script>";
        }
        else{
            $_SESSION['mess'] = "Не удалось добавить товар в корзину!";
            echo "<script>
                    location.href = 'catalog.php?category=$cat&id=$prod&numProd=$numProd&volume_row=$vol_row';
                </script>";
        }
    }
    else{
        $cart = $cart["into_cart"]; // string(8) "{"1": 1}" 
        // print_r($cart);
        $cart = (array) json_decode($cart); //object(stdClass)#2 (1) { ["1"]=> int(1) }
        print_r($cart);
        if (array_key_exists($vol_row, $cart)) {
            $cart[$vol_row]++;
        } else {
            $cart[$vol_row] = 1;
        }
        $into_cart = json_encode($cart);
        $sql = "UPDATE `cart` SET `into_cart` = '$into_cart' where id_user = '$id_user'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            // $_SESSION["cart"] = $into_cart;
            $_SESSION["mess"] = "Товар в корзне!";
            echo "<script>
                location.href = 'catalog.php?category=$cat&id=$prod&numProd=$numProd&volume_row=$vol_row';
            </script>";
        }
        else{
            $_SESSION['mess'] = "Не удалось добавить товар в корзину!";
            echo "<script>
                location.href = 'catalog.php?category=$cat&id=$prod&numProd=$numProd&volume_row=$vol_row';
            </script>";
        }
    }
}
<?php
    include "header.php";
?>

<div id="emtyAboveAcc"></div>

<nav id="navAccount">
    <a href='account.php?page=info'>Данные аккаунта</a>
    <a href='account.php?page=history'>История заказов</a>
    <a href='account.php?page=cart'>Корзина</a>
</nav>
<!-- $userInfo = mysqli_fetch_array(mysqli_query($con, "SELECT id_user, email_user, password_user, bonuses_active, admin_status FROM users WHERE id_user=".$id_user)); -->

<main id="accountMain">
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : false;
        if($page == 'history'){
            $orders = "SELECT `id_order`, `id_user`, `date_order`, `status_order`, `sum_order`, `bonus_minus`, `bonus_plus` FROM `orders` WHERE id_user =".$id_user;
            $num_rows_order = mysqli_num_rows(mysqli_query($con, $orders));
            $orders = mysqli_fetch_all(mysqli_query($con, $orders));
            $item = 1;
            // echo "history";
            echo "<div id='orders'>";
                if($num_rows_order != 0 ){
                    if($item == 1)
                        echo "<div id='oneOrder'>";
                //     $num_row_item = mysqli_query($con, "SELECT COUNT(order_row.id_order) FROM `order_row` JOIN orders ON orders.id_order=order_row.id_order WHERE orders.id_user = ".$id_user." AND order_row.id_order =".$item);
                //     foreach($orders as $item){
                //         if($item = 1){
                //             echo "<div>";
                //         }
                //         echo "<div>
                        
                //         </div>";
                        $item++;
                //     }
                //     echo "<h3></h3>";
                }else{
                    echo 23;
                }
            echo "</div>";
        }
        else if($page == 'cart'){
            echo 'cart';
        }
        else{
            echo "
            <form action='changeAcc.php' method='POST' id='modalAcc'>
                <label class='labelAcc' for='email'> Логин :
                <input class='input' type='text' name='email' value='".$userInfo['email_user']."' readonly></label>
                <label class='labelAcc' for='pass'> Пароль :
                <input class='input' type='text' name='pass' value='".$userInfo['password_user']."' readonly></label>
                <input id='submitModal' type='submit' value='Редактировать данные'>
            </form>";
        }
    ?>
</main>
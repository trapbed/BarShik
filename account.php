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


    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : false;
        if($page == 'history'){
            echo "<main id='accountMainOrder'>";
                $orders = "SELECT `id_order`, `id_user`, `date_order`, `status_order`, `sum_order`, `bonus_minus`, `bonus_plus` FROM `orders` WHERE id_user =".$id_user;
                $num_rows_order = mysqli_num_rows(mysqli_query($con, $orders));
                $orders = mysqli_fetch_all(mysqli_query($con, $orders));
                $item = 1;
                echo "<div id='orders'>";
                    if($num_rows_order != 0 ){
                        if($item == 1)
                        foreach($orders as $item){
                            echo "
                            <div class= 'oneOrder'>";
                            // print_r($item);
                            $status = mysqli_fetch_array(mysqli_query($con, "SELECT name_status FROM status_orders WHERE id_status =".$item[3]));
                            echo "<span class='titleOrder'>Заказ №".$item[0]."</span>";
                            echo "<div class='textOneOrder'>";
                                $date = substr($item[2], 0, 10);
                                $date = date("d.m.Y", strtotime($date));
                                // echo $date;
                                $time = substr($item[2], 11, 10);
                                // echo $time;
                                echo "<span class='dateOrder'>Дата и время заказа</span>";
                                echo "<div class='dateTimeOrder'>
                                    <div class='onlyDateOrder'>
                                        <span class='titleOnly'>Дата</span>
                                        <span>".$date."</span>
                                    </div>
                                    <div class='onlyTimeOrder'>
                                        <span class='titleOnly'>Время</span>
                                        <span>".$time."</span>
                                    </div>
                                </div>";

                                echo "<span class='dateOrder'>Итог</span>";
                                echo "<div class='dateTimeOrder'>
                                    <div class='onlyDateOrder'>
                                        <span class='titleOnly'>Сумма</span>
                                        <span>".$item[4]."</span>
                                    </div>
                                    <div class='onlyTimeOrder'>
                                        <span class='titleOnly'>Списано бонусов</span>
                                        <span>".$item[5]."</span>
                                    </div>
                                    <div class='onlyTimeOrder'>
                                        <span class='titleOnly'>Начисленно бонусов</span>
                                        <span>".$item[6]."</span>
                                    </div>
                                </div>";


                                echo "<span class='dateOrder'>Статус</span>";
                                $status = mysqli_fetch_array(mysqli_query($con,"SELECT name_status FROM status_orders WHERE id_status =".$item[3]))[0];
                                echo "<div class='dateTimeOrder'>
                                    <div class='onlyDateOrder'>
                                        <span class='statusOrder'>".$status."</span>
                                    </div>
                                </div>";

                            echo "</div>
                            </div>
                            ";

                        }
                    }else{
                        echo "У вас еще нет заказов";
                    }
                echo "
            </main>";
        }
        else if($page == 'cart'){
            echo "<main id='accountMain'>";
                $sumCart = 0;
                $num_cart = mysqli_num_rows(mysqli_query($con, "SELECT into_cart from cart where id_user = $id_user"));
                if($num_cart != 0){
                    $allCart = mysqli_fetch_assoc(mysqli_query($con, "SELECT into_cart from cart where id_user = $id_user"))['into_cart'];
                    $allCart = (array) json_decode($allCart);
                    foreach($allCart as $prod => $amount){
                        // print_r($cart);
                        echo "<div class='cartOneProd'>";
                        // echo "SELECT name_product, image_product, volume_of_prod, price_volume JOIN products ON products.id_product=volumes.id_product WHERE id_volume_prod = $prod";
                        $info_prod = mysqli_fetch_array(mysqli_query($con, "SELECT products.name_product, products.image_product, volumes.volume_of_prod, volumes.price_volume FROM volumes JOIN products ON products.id_product = volumes.id_product WHERE volumes.id_volume_prod = $prod"));
                        echo "
                        <img src='../images/products/$info_prod[1]' alt='$info_prod[0]'>
                        <span class='cartOneProdName'><span>Название</span>$info_prod[0]</span>
                        <span class='cartOneProdVol'><span>Объем</span>$info_prod[2]</span>
                        <span class='cartOneProdVol'><span>Цена</span>$info_prod[3] &#8381;</span>


                        <div class='cartOneProdAmount'><a href='editCart.php?act=minus&product=$prod'>-</a><span>$amount</span><a href='editCart.php?act=plus&product=$prod'>+</a></div>
                        </div>";
                        // Продукт: $prod Объем: Количество:$amount
                        echo "<br>";
                        // Продукт: $prod Объем: Количество:$amount
                        $sumCart += $info_prod[3] * $amount;
                        
                    }
                }
                else{
                    echo "
                        <span id='emptyCart'>Корзина пустая!</span>
                    </main>";
                }
            echo "</main>
            <div id='btnNSumCart'>
                <span>Сумма: <font color='#0DB295'>".$sumCart." &#8381;</font></span>
                <form action='buy.php' method='GET'>
                    <label for='use_bonus' > Использовать бонусы
                        <input type='checkbox' name='use_bonus'>
                    </label>
                    <input type='submit' value='Заказать'>
                </form>
            </div>";
        }
        else{
                echo "
                <main id='accountMainInfo'>
                <form action='changeAcc.php' method='POST' id='modalAcc'>
                    <label class='labelAcc' for='email'> Логин :
                    <input class='input' type='text' name='email' value='".$userInfo['email_user']."' readonly></label>
                    <label class='labelAcc' for='pass'> Пароль :
                    <input class='input' type='text' name='pass' value='".$userInfo['password_user']."' readonly></label>
                    <input id='submitModal' type='submit' value='Редактировать данные'>
                </form>
            </main>";
        }
    ?>
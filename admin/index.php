<?php
    include "header.php";
    echo "<div id='emtyAboveAcc'> </div>";
    $page = isset($_GET['page']) ? $_GET['page']  : false ;
// ЗАГОЛОВКИ
    if($page && $page == 'categories'){
        echo "<h3 id='namePageAdmin'> Категории </h3>";
        echo "<div id='startCat'><table></div>
            <tr> 
                <td class='thCat' id='thCat1'>Идентификатор</td>
                <td class='thCat' id='thCat2'>Название</td>
            </tr></table>";
    }
    else if($page && $page== 'products'){
        echo "<h3 id='namePageAdmin'> Продукты </h3>";
        echo "<div id='startProd'><a href='index.php?page=products&prods=products' class='navProdAdmin'>Напитки</a>  <a href='index.php?page=products&prods=volumes' class='navProdAdmin'>Объемы напитков</a></div>";
        $prods = isset($_GET['prods']) ? $_GET['prods'] : false;
        if($prods == 'volumes'){
            // ЗАГОЛОВКИ ОБЪЕМОВ
            echo "<div id='emtyOneProd2'></div>
            <table id='productsAdminTitle'>
                <tr> 
                    <td class='titlePA' id='thV1'>Название</td>
                    <td class='titlePA' id='thV2'>Объем</td>
                    <td class='titlePA' id='thV3'>Цена</td>
                    <td class='titlePA' id='thV4'>Действия</td>
                </tr>
            </table>";
        }
        // ЗАГОЛОВКИ ПРОДУКТОВ
        else{
            echo "<div id='emtyOneProd2'></div>
            <table id='productsAdminTitle'>
            <tr> 
                <td class='titlePA' id='thP1'>Изображение</td>
                <td class='titlePA' id='thP2'>Название</td>
                <td class='titlePA' id='thP3'>Описание</td>
                <td class='titlePA' id='thP4'>Категории</td>
                <td class='titlePA' id='thP5'>Действия</td>
            </tr></table>";
        }
        
    }
    else{
        echo "<h3 id='namePageAdmin'> Заказы </h3>";
        echo "<div id='emtyOneProd2'></div>
            <table class='ordersAdmin'>
                <tr> 
                    <td class='titleOAN' id='thO1'>Номер</td>
                    <td class='titleOAU' id='thO2'>Пользователь</td>
                    <td class='titleOAD' id='thO3'>Дата</td>
                    <td class='titleOASu' id='thO4'>Сумма</td>
                    <td class='titleOASt' id='thO5'>Статус</td>
                    <td class='titleOAM' id='thO6'>Подробнее</td>
                </tr>
            </table>";
    }
// ТАБЛИЦЫ СО СКРОЛЛОМ
    echo "<div id='scrollAdmin'>";
    if($page && $page == 'categories'){
        $categories = mysqli_fetch_all(mysqli_query($con, "SELECT `id_category`, `name_category` FROM `categories`"));
        $checkCat = 0;
        echo "<table class='tableAdminCat'>";
            foreach($categories as $cat){
                if($checkCat == 0){
                    echo "<tr>";
                    $checkCat = 1;
                }
                    echo "<td class='idCategory'>".$cat[0]."</td>
                          <td class='nameCategory'>".$cat[1]."</td>";
                if($checkCat == 1){
                    echo "</tr>";
                    $checkCat = 0;
                }
            }
        echo "";
    }
    else if($page && $page == 'products'){
        // СТРАНИЦА
        $prods = isset($_GET['prods']) ? $_GET['prods'] : false;
        // ВЫВОД ОБЪЕМОВ
        if($prods == 'volumes'){
            $count_row_vol = 0;
            $volumes = "SELECT products.name_product, volume_of_prod, price_volume FROM volumes JOIN products ON products.id_product=volumes.id_product";
            $num_row_vol = mysqli_num_rows(mysqli_query($con, $volumes));
            $volumes = mysqli_fetch_all(mysqli_query($con, $volumes));

            $lastProd = false;
            foreach($volumes as $volume){
                if($lastProd != false && $lastProd != $volume[0]){
                    echo "<tr class='emtyRow'>
                    <td>&nbsp; </td>
                    <td>&nbsp; </td>
                    <td>&nbsp; </td>
                    <td>&nbsp; </td>
                    </tr>";
                }
                $lastProd = $volume[0];
                if($count_row_vol == 0){
                    echo "<table id='productsAdminTitle'>";
                }
                echo "<tr> 
                    <td class='adminVN'>".$volume[0]."</td>
                    <td class='adminVV'>".$volume[1]."</td>
                    <td class='adminVP'>".$volume[2]."</td>
                    <td class='adminVA'> <form action='' method=''>        </form> </td>
                </tr>";
                if($count_row_vol == $num_row_vol){
                    echo "</table>";
                }
                $count_row_vol++;
            }
        }
        // ВЫВОД ПРОДУКТОВ
        else{
            $products = "SELECT id_product, image_product, name_product, desc_product, id_category_prod FROM products";
            // echo "Напитки";
            $numProd = mysqli_num_rows(mysqli_query($con, $products));
            $products = mysqli_fetch_all(mysqli_query($con, $products));
            $countProd = 0;
            foreach($products as $prod){
                if($countProd == 0){
                    echo "<table id='productsAdminTitle' >";
                }
                echo "<tr>
                <td class='prodImg'><img src='../images/products/".$prod[1]."' alt='' class='imgAdminProd'></td>
                <td class='prodName'>".$prod[2]."</td>
                <td class='prodDesc'>".$prod[3]."</td>";

                $catProd = "SELECT name_product, name_category FROM categories_of_products JOIN products ON products.id_product=categories_of_products.id_product JOIN categories ON categories.id_category=categories_of_products.id_category WHERE categories_of_products.id_product =".$prod[0];
                $catProd = mysqli_fetch_all(mysqli_query($con, $catProd));
                $countCatProd = 1;
                echo "<td class='prodCat'>";
                foreach ($catProd as $cat_pro){
                    echo $countCatProd." ".$cat_pro[1]."<br><br>";
                    $countCatProd++;
                }
                echo "</td>
                <td class='prodAction'> <form action='' method=''>        </form> </td>
                </tr>";
                if($countProd == $numProd){
                    echo "</table>";
                }
                $countProd++;
            }
        }
    }
    // ORDERS
    else {
        $statuses = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM status_orders ORDER BY status_orders.id_status ASC"));
        $orderRow = "SELECT id_order, users.email_user, date_order, status_order, sum_order FROM `orders` JOIN users ON users.id_user=orders.id_user";
        
        $countOrder = 1;
        $numOrderRow = mysqli_num_rows(mysqli_query($con, $orderRow));
        $orderRow = mysqli_fetch_all(mysqli_query($con, $orderRow));
        foreach($orderRow as $one_order){
            if($countOrder == 1){
                echo"<table class='ordersAdmin'>";
            }
            echo "<tr> 
                    <td class='titleOAN' >".$one_order[0]."</td>
                    <td class='titleOAU' >".$one_order[1]."</td>
                    <td class='titleOAD' >".$one_order[2]."</td>
                    <td class='titleOASu' >".$one_order[4]." &#8381; </td>
                    <td class='titleOASt' ><form method='GET' action=''>
                    <input type='hidden' name='id_order' value='".$one_order[0]."'>
                    <select name='status' id=''>";
                        foreach ($statuses as $status){
                            echo "<option value='".$status[0]."'";
                                if($status[0] == $one_order[3]){
                                    echo "selected";
                                }
                            echo ">".$status[1]."<option>";
                        }
                    echo "</select></form></td>
                    <td class='titleOAM' ><form method='GET' action=''></form></td>
                </tr>";
            if($countOrder == $numOrderRow){
                echo "</table>";
            }
            $countOrder++;
        }

    }




    echo "</div>";
?>


<!-- <a href=''><img src='' alt='' title=''></a> -->


<!-- SELECT id_order, users.email_user, date_order, status_order FROM `orders` JOIN users ON users.id_user=orders.id_user  WHERE id_user = -->



<!-- ФОРМА ДЛЯ ВЫВОДА СТАТУСОВ ЗАКАЗА -->

<!-- <form action='' method='GET' ><
                <select>";
                // if(){

                // }
                // else{

                // }
                echo "</select>
                </form>  -->
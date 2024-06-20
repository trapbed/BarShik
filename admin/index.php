<?php
session_start();
    include "header.php";
    echo "<div id='emtyAboveAcc'> </div>";
    $page = isset($_GET['page']) ? $_GET['page']  : false ;
// ЗАГОЛОВКИ
    // ЗАГОЛОВКИ КАТЕГОРИЙ
    if($page && $page == 'categories'){
        echo "<div class='createNName' >
                    <h3 id='namePageAdmin'> Категории </h3> 
                    <a class='createAdmin' href='createCategory.php'> Добавить категорию</a>
              </div>";
        echo "<div id='startCat'><table></div>
            <tr> 
                <td class='thCat' id='thCat1'>Идентификатор</td>
                <td class='thCat' id='thCat2'>Название</td>
                <td class='thCat' id='thCat3'>Действия</td>
            </tr></table>";
    }
    // ЗАГОЛОВКИ ПРОДУКТОВ И ОБЪЕМОВ
    else if($page && $page== 'products'){
        $prods = isset($_GET['prods']) ? $_GET['prods'] : false;
        echo "<div class='createNName' >
                    <h3 id='namePageAdmin'> Продукты </h3>";
                    if($prods && $prods == 'products'){
                        echo "<a class='createAdmin' href='createProduct.php'>Добавить продукт</a>";
                    }
                echo "</div>";
        echo "<div id='startProd'><a href='index.php?page=products&prods=products' class='navProdAdmin'>Напитки</a>  <a href='index.php?page=products&prods=volumes' class='navProdAdmin'>Объемы напитков</a></div>";
        // ЗАГОЛОВКИ ОБЪЕМОВ
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
                <td class='titlePA' id='thP6'>Объем/Цена</td>
                <td class='titlePA' id='thP4'>Категории</td>
                <td class='titlePA' id='thP5'>Действия</td>
            </tr></table>";
        }
        
    }
    else if($page && $page == "stat"){
        $from_stat = isset($_GET["from"]) ? $_GET["from"] : false;
        $to_stat = isset($_GET["to"]) ? $_GET["to"] : false;
        $today = date("Y-m-d");
        echo "<h5 id='admin_page_stat'>Статистика</h5>";
        echo "<br>";
        echo "<form method='GET' action='../admin/index.php?page=stat' id='stat_admin'>
            <input type='hidden' name='page' value='stat'>
            <label for='from' >с
                <input type='date' name='from' id='from_stat' max='$today' value='".$from_stat."'>
            </label>
            <label for='to' >по
                <input type='date' name='to' id='to_stat' min='' max='$today' value='".$to_stat."'>
            </label>
        </form>";
        echo "<br>";
        echo "<div class='title_stat_admin'>
            <span class='date_stat_order'>Дата</span>
            <span class='amount_stat_order'>Количество заказов</span>
            <span class='sum_stat_order'>Сумма заказов</span>
        </div>";
        echo "<br>";

        // $all_orders = mysqli_fetch_all(mysqli_query($con,"SELECT * FROM"));
    }
    // ЗАГОЛОВКИ ЗАКАЗОВ
    else{
        echo "<div class='createNName' >
                    <h3 id='namePageAdmin'> Заказы </h3>
              </div>";
        echo "<div id='emtyOneProd2'></div>
            <table class='ordersAdmin' id='ordersAdmin'>
                <tr> 
                    <td class='titleOAN' id='thO1'>Номер</td>
                    <td class='titleOAU' id='thO2'>Пользователь</td>
                    <td class='titleOAD' id='thO3'>Дата</td>
                    <td class='titleOASu' id='thO4'>Сумма</td>
                    <td class='titleOAM' id='thO6'>Списано бонусов </td>
                    <td class='titleOAM' id='thO6'>Начислено бонусов</td>
                    <td class='titleOASt' id='thO5'>Статус</td>
                </tr>
            </table>";
    }




// ДОБАВЛЕНИЕ
// ТАБЛИЦЫ СО СКРОЛЛОМ

    echo "<div id='scrollAdmin'>";
// КАТЕГОРИИ

    if($page && $page == 'categories'){
        $categories = mysqli_fetch_all(mysqli_query($con, "SELECT `id_category`, `name_category` FROM `categories`"));
        $checkCat = 0;
        echo "<table class='tableAdminCat'>";
            foreach($categories as $cat){
                if($checkCat == 0){
                    echo "<tr>";
                    $checkCat = 1;
                }
                $check_exist = mysqli_fetch_array(mysqli_query($con, "SELECT exist FROM categories WHERE id_category=$cat[0]"));
                    echo "<td class='idCategory'>".$cat[0]."</td>
                          <td class='nameCategory'>".$cat[1]."</td>
                          <td class='actionCategory'>
                            <form action='updateCat-db.php' method='POST'>
                                <input type='hidden' name='idCat' value='".$cat[0]."'>
                                <input class='updateCatAct' type='submit' value=''>
                            </form>

                            <form id='actionCatForm' action='";
                            if($check_exist[0] == 1) {
                                echo "deleteCat-db.php";
                            }else{
                                echo "recoverCat-db.php";
                            } 
                            echo "' method='POST'>
                                <input class='deleteCatAct' type='hidden' name='idCat' value='".$cat[0]."'>
                                <input class='";
                                if($check_exist[0] == '1') {
                                    echo 'deleteCatAct';
                                }else{
                                    echo 'recoverCatAct';
                                }
                                echo "' type='submit' value=''>
                            </form>
                          </td>";
                        //   echo "<input class='";
                        // if($check_exist[0] == 1) {
                        //     echo "deleteCatAct";
                        // }else{
                        //     echo "recoverCatAct";
                        // } 
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
            $volumes = "SELECT products.name_product, volume_of_prod, price_volume, products.id_product, id_volume_prod FROM volumes JOIN products ON products.id_product=volumes.id_product";
            $num_row_vol = mysqli_num_rows(mysqli_query($con, $volumes));
            $volumes = mysqli_fetch_all(mysqli_query($con, $volumes));
            $countRowVol = 1;

            $lastProd = false;
            foreach($volumes as $volume){
                $numRowVol = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM `volumes` WHERE id_product=".$volume[3]));
                
                // echo $numRowVol[0];
                // $lastProd != false && $lastProd != $volume[0]
                
                
                $lastProd = $volume[0];
                if($count_row_vol == 0){
                    echo "<table id='productsAdminTitle'>";
                }
                echo "<tr> 
                    <td class='adminVN'>".$volume[0]."</td>
                    <td class='adminVV'>".$volume[1]."</td>
                    <td class='adminVP'>".$volume[2]."</td>
                    <td class='adminVA'>
                        <form action='updateVolume.php' method='POST'>
                                <input type='hidden' name='idRowVol' value='".$volume[4]."'>
                                <input class='updateCatAct' type='submit' value=''>
                        </form>


                        <form id='actionCatForm' action='preDeleteVolume-db.php' method='POST'>
                                <input class='deleteCatAct' type='hidden' name='idRowVol' value='".$volume[4]."'>
                                <input class='deleteCatAct' type='submit' value=''>
                        </form>
                    </td>
                </tr>";
                if($countRowVol == $numRowVol[0]){
                    echo "<tr class='emtyRow'>
                    <td>&nbsp; </td>
                    <td>&nbsp; </td>
                    <td>&nbsp; </td>
                    <td> 
                        <form class='' action='createVolume.php' method='POST'>
                            <input name='idProd' type='hidden' value='".$volume[3]."'>
                            <input class='createVol' type='submit' value='Создать для ".$volume[0]."'>
                        </form>
                    </td>
                    </tr>";
                    $countRowVol=0;
                }
                if($count_row_vol == $num_row_vol){
                    echo "</table>";
                }
                $count_row_vol++;
                $countRowVol++;

            }
        }
        // ВЫВОД ПРОДУКТОВ
        else{
            $products = "SELECT id_product, image_product, name_product, desc_product FROM products";
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
                <td class='prodDesc'>".$prod[3]."</td>
                <td class='prodVol'>";
                $volumesProd = mysqli_query($con, "SELECT `id_volume_prod`, `id_product`, `volume_of_prod`, `price_volume` FROM `volumes` WHERE id_product=".$prod[0]);
                $numVP = mysqli_num_rows($volumesProd);
                $volumesProd = mysqli_fetch_all($volumesProd);
                $countVP = 1;
                if($numVP != 0){
                    foreach($volumesProd as $vp){
                        echo "<div class='inlineVol'> <span>$vp[2]</span>/<span>$vp[3] &#8381;</span> <a href='preDeleteVolProd-db.php?id=".$vp[0]."'><div class='deleteVolProd'></div></a> </div> <br>";
                        if($countVP == $numVP){
                            echo "<br><br><a class='updateVolInProd' href='index.php?page=products&prods=volumes'>Изменить объем</a>";
                            $countVP = 0;
                        }
                        $countVP++;
                    }
                }
                else{
                    echo "<a class='updateVolInProd' href='index.php?page=products&prods=volumes'>Изменить объем</a>";
                }
                
                echo"</td>";
                
                $catProd = "SELECT DISTINCT name_product, name_category, categories_of_products.id_product, categories_of_products.id_category FROM categories_of_products JOIN products ON products.id_product=categories_of_products.id_product JOIN categories ON categories.id_category=categories_of_products.id_category WHERE categories_of_products.id_product =".$prod[0];
                $numCatProd = mysqli_num_rows(mysqli_query($con, $catProd));
                $catProd = mysqli_fetch_all(mysqli_query($con, $catProd));
                $countCatProd = 1;
                echo "<td class='prodCat'>";
                if($numCatProd != 0){
                    foreach ($catProd as $cat_pro){
                        echo "<a class='catsProds' href='preDeleteCatProd.php?prod=".$cat_pro[2]."&cat=".$cat_pro[3]."'>".$countCatProd." ".$cat_pro[1]."</a>";
                        echo "<br><br>";
                        $countCatProd++;
                        if($numCatProd < $countCatProd){
                        echo "<a class='addCatProd' href='addCatForProd.php?idProd=".$cat_pro[2]."'>Добавить категорию</a>";
                    }
                    }
                    
                }
                else{
                    echo "<a class='addCatProd' href='addCatForProd.php?idProd=".$cat_pro[2]."'>Добавить категорию</a>";
                }
                echo "</td>";


                $check_exist = mysqli_fetch_array(mysqli_query($con, "SELECT exist FROM `products` WHERE id_product=$cat_pro[2]"));

                $today = date("Y-m-d");
                echo "<td class='prodAction'>
                
                    <form action='updateProd.php' method='POST'>
                        <input type='hidden' name='idProd' value='".$prod[0]."'>
                        <input class='updateCatAct' type='submit' value='' >
                    </form>


                    <form id='actionCatForm' action='";
                    if($check_exist[0] == 1) {
                        echo "preDeleteProd-db.php";
                    }else{
                        echo "preRecoverProd-db.php";
                    } 
                    echo "' method='POST'>
                        <input class='deleteCatAct' type='hidden' name='idProd' value='".$prod[0]."'>";
                        echo "<input class='";
                        if($check_exist[0] == 1) {
                            echo "deleteCatAct";
                        }else{
                            echo "recoverCatAct";
                        } 
                        echo "' type='submit' value=''>";
                    echo "</form>
                
                </td>
                </tr>";
                if($countProd == $numProd){
                    echo "</table>";
                }
                $countProd++;
            }
        }
    }
    else if($page && $page == "stat"){
        $date_from = isset($_GET["from"]) ? $_GET["from"] : false;
        $date_to = isset($_GET["to"]) ? $_GET["to"] : false;
        
        if($date_from && $date_to){
            $arr_between_dates = [];
            while(date($date_from )<= date($date_to)){
                array_push($arr_between_dates, $date_from);
                $date_from = strtotime("$date_from +1day");
                $date_from = date("Y-m-d", $date_from);
            }
            // print_r($arr_between_dates);
            foreach($arr_between_dates as $date){
                $query_stat = mysqli_query($con, "SELECT sum_order FROM orders WHERE date_order LIKE '%$date%'");
                $num_orders = mysqli_num_rows($query_stat);
                // echo $num_orders;
                $sum_orders_day = 0;
                // echo "SELECT sum_order FROM orders WHERE date_order LIKE '%$date%'";
                if($num_orders > 0){
                    $sum_orders = mysqli_fetch_all($query_stat);
                    foreach($sum_orders as $sum){
                        $sum_orders_day += $sum[0];
                    }
                    $num_orders_day = $num_orders;
                    // $sum_orders_day += $
                }
                else{
                    $num_orders_day = 0;
                    $sum_orders_day = 0;
                }
                // $date = date($date, "d-m-Y");
                $day = substr($date,8,2 );
                $month = substr($date,5,2);
                switch($month){
                    case "01":
                        $month = "Января";
                        break;
                    case "02":
                        $month = "Февраля";
                        break;
                    case "03":
                        $month = "Марта";
                        break;
                    case "04":
                        $month = "Апреля";
                        break;
                    case "05":
                        $month = "Мая";
                        break;
                    case "06":
                        $month = "Июня";
                        break;
                    case "07":
                        $month = "Июля";
                        break;
                    case "08":
                        $month = "Августа";
                        break;
                    case "09":
                        $month = "Сентября";
                        break;
                    case "10":
                        $month = "Октября";
                        break;
                    case "11":
                        $month = "Ноября";
                        break;
                    case "12":
                        $month = "Декабря";
                        break;
                }
                $year = substr($date,0,4);
                $first_sym_day = substr($day,0,1);
                if($first_sym_day == '0'){
                    $day = substr($day,1,1);
                }
                $date = $day." ".$month." ".$year." года";
                echo "<div class='title_stat_admin'>
                    <span class='date_stat_order'>$date</span>
                    <span class='amount_stat_order'>$num_orders_day</span>
                    <span class='sum_stat_order'>$sum_orders_day</span>
                </div>";
            }
            
        }
        else{
            echo "<span>Выберите даты</span>";
        }
    }
    // ORDERS
    else {
        $statuses = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM status_orders ORDER BY status_orders.id_status ASC"));
        $orderRow = "SELECT id_order, users.email_user, date_order, status_order, sum_order, bonus_minus, bonus_plus FROM `orders` JOIN users ON users.id_user=orders.id_user";
        
        $countOrder = 1;
        $numOrderRow = mysqli_num_rows(mysqli_query($con, $orderRow));
        $orderRow = mysqli_fetch_all(mysqli_query($con, $orderRow));
        foreach($orderRow as $one_order){
            if($countOrder == 1){
                echo"<table class='ordersAdmin'>";
            }
            // print_r($statuses);

            echo "<tr> 
                    <td class='titleOAN' >".$one_order[0]."</td>
                    <td class='titleOAU' >".$one_order[1]."</td>
                    <td class='titleOAD' >".$one_order[2]."</td>
                    <td class='titleOASu' >".$one_order[4]." &#8381; </td>
                    <td class='titleOAM' >$one_order[5]</td>
                    <td class='titleOAM' >$one_order[6]</td>
                    <td class='titleOASt' >
                    <form method='GET' action='status_order_change.php'>
                    <input type='hidden' name='id_order' value='".$one_order[0]."'>
                    <select name='status' class='statusChange'>";
                        foreach ($statuses as $status){
                            echo "<option value='".$status[0]."'";
                                if($status[0] == $one_order[3]){
                                    echo "selected";
                                }
                            echo ">".$status[1]."<option>";
                        }
                    echo "</select>
                    <input type='submit' value='ок'>
                    </form></td>
                </tr>";
            if($countOrder == $numOrderRow){
                echo "</table>";
            }
            $countOrder++;
        }

    }




    echo "</div>";
?>

<script>
    $('#from_stat').change(function(){
        let date = new Date($('#from_stat').val());
        min2 = new Date(date.setDate(date.getDate() + 1));
        let day = min2.getDate();
        if(day.toString().length < 1){
            day = "0"+day;
        }
        let month = min2.getMonth()+1;
        if(month.toString().length!=2){
            month = "0"+month;
        }
        min2 = min2.getFullYear() + '-' + month + '-' + day;
        $('#to_stat').attr("min", min2);
    })
    $("#to_stat").change(function(){
        $("#stat_admin").submit();
        $('#to_stat').attr("min", "");
    })
</script>
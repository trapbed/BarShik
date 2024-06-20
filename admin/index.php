<?php
session_start();
echo isset($_SESSION['check']) ? $_SESSION['check'] : false;
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
                    <td class='titleOASt' id='thO5'>Статус</td>
                    <td class='titleOAM' id='thO6'>Подробнее</td>
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

                echo "<td class='prodAction'>
                
                    <form action='updateProd.php' method='POST'>
                        <input type='hidden' name='idProd' value='".$prod[0]."'>
                        <input class='updateCatAct' type='submit' value=''>
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
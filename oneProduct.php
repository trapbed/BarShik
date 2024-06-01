<?php
if(isset($_GET['id']) && $_GET['id'] != ' '){
    $products = "SELECT DISTINCT name_product, desc_product, name_category, image_product, products.id_product FROM `products` JOIN categories_of_products ON categories_of_products.id_product=products.id_product JOIN categories ON categories.id_category=categories_of_products.id_category WHERE products.id_product =".$_GET['id'];
    $queryProd = mysqli_fetch_array(mysqli_query($con, $products));

    echo "<div id='backModal'></div>
            <div id='modalReg'>
                <img src='../images/close.png' alt='close' id='closeOneProd'>
                <div id='imgOneProd'><img src='../images/products/".$queryProd[3]."' alt=''></div>
                <div id='infoOneProd'>
                    <h3 id='nameProd'>$queryProd[0]</h3>
                    <div id='rating'>
                        <img src='../images/star.svg' alt=''>
                        <span id='numRat'>5.0</span>
                        <span id='amountRat'>(2343 оценок)</span>
                    </div>
                    <div id='emtyOneProd'></div>
                    <div id='descProd'>
                        <span id='desc'>$queryProd[1]</span>
                        <div></div>
                        <span id='more'>Читать полностью</span>
                    </div>
                    <div id='allBeforePos'>
                        <div id='offersOneProd'>
                            <span>Специальное предложение</span>
                            <div id='offerBtm'>
                                <div id='offerBtmLeft'>
                                    <img src='../images/checkMark.svg' alt='check mark'>
                                    <div id='emtyOneProd1'></div>
                                    <div id='offerLeftBtm'>
                                        <span id='offerLeftTop'>Оплатите заказ баллами до 30%</span>
                                        <span id='offerLeftBtm'>Вернем 5% бонусами</span>
                                    </div>
                                </div>
                                <div id='offerBtmRight'>
                                    <span id='offerRightTop'>- 40 бонусов</span>
                                    <span id='offerRightBtm'>Отменить</span>
                                </div>
                            </div>
                        </div>
                        <div id='emtyOneProd2'></div>
                        <div id='volumeOneProd'>
                            <span>Объем</span>
                            <div id='volumesProd'>";
                            $id_volume = isset($_GET['volume_row']) ? $_GET['volume_row'] : false ;

                            $queryVolume = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM `volumes` WHERE id_product=".$_GET['id']));
                            if( isset($_GET['volume_id']) && $id_volume != false){
                                $queryVolume .= " AND id_volume_prod=".$id_volume ;
                            }

                            // ADD FORM
                            foreach($queryVolume as $volume){
                                echo "<form method='GET' action='catalog.php'>
                                    <input type='hidden' name='category' value='".$_GET['category']."'>
                                    <input type='hidden' name='id' value='".$_GET['id']."'>
                                    <input type='hidden' name='numProd' value='".$_GET['numProd']."'>
                                    <input type='hidden' name='volume_row' value='".$volume[0]."'>";                                
                                    
                                    if($id_volume == $volume[0]){
                                        echo "<input type='submit' class='oneV' id='birusaOneProd' name='volume' value='".$volume[2]."'>";
                                    }
                                    else if ($id_volume != $volume[0]){
                                        echo "<input type='submit' class='oneV' name='volume' value='".$volume[2]."'>";
                                    }
                                echo "</form>";

                            }
                        echo "</div>
                        </div>
                        <div id='emtyOneProd3'></div>
                        <div id='priceNBtn'>
                            <div id='PriceProd'>
                                <span id='namePrice'>Цена</span>";

                                $check_price = false;
                                $price_vol = "SELECT price_volume FROM volumes WHERE id_product=".$_GET['id'];

                                if($id_volume && $id_volume != false){
                                    if($id_volume && $id_volume != false){
                                        $price_vol .= " AND id_volume_prod = ".$id_volume;
                                        $check_price = true;
                                    }
                                }
                                $price_vol =  mysqli_fetch_all(mysqli_query($con, $price_vol));

                                if(isset($_GET['volume'])){
                                    echo "<span id='justPrice'>".$price_vol[0][0]." &#8381;</span>";
                                }
                                else{
                                    echo "<span id='justPrice'> от ".$price_vol[0][0]." &#8381;</span>";
                                }
                            
                                $vol_row = isset($_GET['volume_row']) ? $_GET['volume_row'] : false;

                            echo "</div>
                            <form action='toCart.php' method='GET'>
                                <input type='hidden' name='vol_row' value = '".$vol_row."'>
                                
                                <input type='submit' value='В корзину' id='toCart'>
                            </form>
                        </div>
                    </div>
                </div>
            </div> ";
}
?>
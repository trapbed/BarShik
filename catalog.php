<?php
    include "connect-db.php"; 

    session_start();
    //last page
    
    $onlyCat =  mysqli_fetch_all(mysqli_query($con, "SELECT * FROM categories"));

    $categories = mysqli_fetch_all(mysqli_query($con, " SELECT id_category, name_category FROM categories "));
    $products = '' ;
    $setCat = isset($_GET['category']) ? $_GET['category'] : false;
    // echo $setCat;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id='catalogNav'>

<?php
if(isset($_GET['id']) && $_GET['id'] != ' '){
    $products = "SELECT DISTINCT name_product, desc_product, name_category, price_product, image_product, products.id_product FROM `products` JOIN categories_of_products ON categories_of_products.id_product=products.id_product JOIN categories ON categories.id_category=products.id_category_prod WHERE products.id_product =".$_GET['id'];
    $queryProd = mysqli_fetch_array(mysqli_query($con, $products));

    echo "
   
<div id='backModal'></div>
    <div id='modalReg'>
        <img src='../images/close.png' alt='close' id='closeOneProd'>
        <div id='imgOneProd'><img src='../images/products/".$queryProd[4]."' alt=''></div>
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
                    $queryVolume = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM `volumes` WHERE id_product=".$_GET['id']));

                    // ADD FORM
                    foreach($queryVolume as $volume){
                        echo "<div class='oneV'>".$volume[1]."</div>";
                    }
                echo "</div>
                </div>
                <div id='emtyOneProd3'></div>
                <div id='priceNBtn'>
                    <div id='PriceProd'>
                        <span id='namePrice'>Цена</span>
                        <span id='justPrice'>".$queryProd[3]." &#8381;</span>
                    </div>
                    <form action='' method='GET'>
                        <input type='hidden' name=''>
                        <input type='submit' value='В корзину' id='toCart'>
                    </form>
                </div>
            </div>
        </div>
    </div> 

</body>
</html>";
// $_GET['id'] = '';
}
?>

    <nav>
        <div id='forNav'>
            <a href='catalog.php' class='fizzBackWord' id='logo'>fizz</a>
            <div id='navThreeDivs'>
                <div class='infoAccNav'><img src="../images/ruble.png" alt="ruble" id='ruble'> <span>0</span></div>
                <div class='infoAccNav'><img src="../images/shopBasket.png" alt="basket" id='basket'> <span>0</span></div>
                <button id='logOut'>Выйти</button>
            </div>
        </div>
        
    </nav>

    <div id="catForForm">
        <?php
            foreach ($onlyCat as $cat){
                echo "<form action='catalog.php' method='GET'>
                    <input name='category' type='hidden' value='$cat[0]'>
                    <input name='catName'";
                    if($setCat == $cat[0]){
                        echo "id='turquoise'";
                    }
                    else{
                        echo "id='white'";
                    }
                    echo " class='whereCatalog' type='submit' value='$cat[1]'>
                </form>";
            }
        ?>
    </div>

    <main id="catalogProducts">
            <?php

                $category = isset($_GET['category']) ? $_GET['category'] : false;
                $products = "SELECT DISTINCT name_product, desc_product, name_category, price_product, image_product, products.id_product FROM `products` JOIN categories_of_products ON categories_of_products.id_product=products.id_product JOIN categories ON categories.id_category=products.id_category_prod";
                // $products = "SELECT name_product, desc_product, name_category, price_product, image_product, id_product FROM products JOIN categories ON categories.id_category=products.id_category_prod";
                if($category != false && $category){
                    $products.= " WHERE categories_of_products.id_category = ".$_GET['category'];
                }
                $queryProd = mysqli_fetch_all(mysqli_query($con, $products));
                $checkNumProd = 0;

                foreach($queryProd as $prod){
                    if($checkNumProd==0){
                        echo "<div class='fourProducts'>";
                    }
                    echo "<div class='productCat'>
                        <img src='/images/products/$prod[4]' alt='$prod[0]' class='imagesProducts'>
                        <div class='infoProd'>
                            <div class='volumeName'>
                                <span class='volumeProd'>Новинка</span>
                                <span class='nameProd'>$prod[0]</span>
                            </div>
                            <div class='pricePlus'>
                                <span class='priceProd'>&#8381; $prod[3]</span>
                                <a class='plusProd' href='catalog.php?id=".$prod[5]."'>+</a>
                            </div>
                        </div>
                    </div>";
                    
                    if($checkNumProd!=3){
                        echo"<div class='emtyBetween'></div>";
                    }

                    $checkNumProd +=1;

                    if($checkNumProd==4){
                        echo "</div>";
                        echo "<div class='emtyProd'></div>";
                        $checkNumProd = 0;
                    }
                }

            ?>
    </main>

    <?php
        $_SESSION['http'] =  isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false;
        // echo $_SESSION['http'];
    ?>

    <script>
    let back = document.getElementById('backModal');
    let modal = document.getElementById('modalReg');
    let body = document.querySelector('body');
    let close = document.getElementById('closeOneProd');

    let btns = document.getElementsByClassName('plusProd');
    for(let i=0 ; i < btns.length; i++){
        btns[i].addEventListener('click', function(){
            body.style.overflowY = 'hidden';
            back.style.height = '100vmin';
            modal.style.top = '50%';
        })
    }
    back.addEventListener('click', function(){
        body.style.overflowY = 'visible';
        back.style.height = '0vmax';
        modal.style.top = '-50%';
    })

    close.addEventListener('click', function(){
        body.style.overflowY = 'visible';
        back.style.height = '0vmax';
        modal.style.top = '-50%';
    })
    </script>
    <?php
    $_SESSION['server'] = $_SERVER['HTTP_REFERER'];
    
    ?>
</body>
</html>
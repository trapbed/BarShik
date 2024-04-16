<?php
    include "header.php";
    // ancor linlk
    $_SESSION['numProd'] = isset($_GET['numProd']) ? $_GET['numProd'] : (isset($_SESSION['numProd']) ? $_SESSION['numProd'] : false) ;
    $numProdSess = "product".$_SESSION['numProd'];
    
    $onlyCat =  mysqli_fetch_all(mysqli_query($con, "SELECT * FROM categories"));

    $categories = mysqli_fetch_all(mysqli_query($con, " SELECT id_category, name_category FROM categories "));
    $products = '' ;
    $setCat = isset($_GET['category']) ? $_GET['category'] : false;  
    


    include "oneProduct.php";
    echo mysqli_insert_id($con);
?>


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
                $products = "SELECT DISTINCT name_product, desc_product, products.id_product, image_product, products.id_product FROM `products` JOIN categories_of_products ON categories_of_products.id_product=products.id_product JOIN categories ON categories.id_category=categories_of_products.id_category ";
                // $products = "SELECT name_product, desc_product, name_category, price_product, image_product, id_product FROM products JOIN categories ON categories.id_category=products.id_category_prod";
                if($category != false && $category){
                    $products.= " WHERE categories_of_products.id_category = ".$_GET['category'];
                }
                $queryProd = mysqli_fetch_all(mysqli_query($con, $products));
                $checkNumProd = 0;

                $numProd = 1;

                foreach($queryProd as $prod){
                        
                        $price_vol = "SELECT price_volume FROM volumes WHERE id_product=".$prod[2];
                        $price_vol =  mysqli_fetch_all(mysqli_query($con, $price_vol));

                    if($checkNumProd==0){
                        echo "<div class='fourProducts'>";
                    }
                    echo "<div class='productCat'>
                        <img src='/images/products/$prod[3]' alt='$prod[0]' class='imagesProducts'>
                        <div class='infoProd'>
                            <div class='volumeName'>
                                <span class='volumeProd'>Новинка</span>
                                <span class='nameProd'>$prod[0]</span>
                            </div>
                            <div class='pricePlus'>
                                <span class='priceProd'> от ".$price_vol[0][0]." &#8381;</span>
                                <a class='plusProd' id='product".$numProd."' href='catalog.php?category=".$setCat."&id=".$prod[2]."&numProd=".$numProd."'>+</a>
                            </div>
                        </div>
                    </div>";

                    $numProd++;

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
            <div class='emtyProd'></div>
    </main>

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
            location.href = 'catalog.php<?= isset($_GET['category']) ? "?category=".$_GET['category']."#$numProdSess" : "#$numProdSess" ;?>';
            <?$_GET['id'] = false?>
        })
        close.addEventListener('click', function(){
            body.style.overflowY = 'visible';
            back.style.height = '0vmax';
            modal.style.top = '-50%';
            location.href = 'catalog.php<?= isset($_GET['category']) ? "?category=".$_GET['category']."#$numProdSess" : "#$numProdSess" ;?>';
            <?$_GET['id'] = false?>
        })
    </script>
    <script src='../js/modalReg.js'></script>

</body>
</html>
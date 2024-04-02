<?php
    include "connect-db.php";
    $categories = mysqli_fetch_all(mysqli_query($con, " SELECT id_category, name_category FROM categories "));
    $products = '' ;
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
    <nav>
        <div id='forNav'>
            <a href='catalog.php' class='fizzBackWord' id='logo'>fizz</a>
            <div id='navThreeDivs'>
                <div class='infoAccNav'><img src="../images/ruble.png" alt="ruble" id='ruble'> <span>0</span></div>
                <div class='infoAccNav'><img src="../images/shopBasket.png" alt="basket" id='basket'> <span>0</span></div>
                <button id='logOut'>Войти</button>
            </div>
        </div>
        
    </nav>

    <div id="catForForm">
        <?php
            foreach ($categories as $cat){
                echo "<form action='catalog.php' method='GET'>
                    <input name='category' class='whereCatalog' type='hidden' value='$cat[0]'>
                    <input name='catName' class='whereCatalog' type='submit' value='$cat[1]'>
                </form>";
            }
        ?>
    </div>

    <main id="catalogProducts">
            <?php
                $category = isset($_GET['category']) ? $_GET['category'] : false;
                $products = "SELECT name_product, desc_product, name_category, price_product, image_product, volume_of_liquid FROM products JOIN categories ON categories.id_category=products.id_category_prod";
                if($category != false && $category){
                    $products.= " WHERE products.id_category_prod=".$_GET['category'];
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
                                <span class='volumeProd'>$prod[5]</span>
                                <span class='nameProd'>$prod[0]</span>
                            </div>
                            <div class='pricePlus'>
                                <span class='priceProd'>&#8381; $prod[3]</span>
                                <div class='plusProd'>+</div>
                            </div>
                        </div>
                    </div>";
                    
                    if($checkNumProd!=3){
                        echo"<div class='emtyBetween'></div>";
                    }

                    $checkNumProd +=1;

                    if($checkNumProd==4){
                        echo "</div>";
                    }
                }

            ?>
    </main>

</body>
</html>
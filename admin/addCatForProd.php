<?php
    include "header.php";

    $id = $_GET['idProd'];

    $nameProd = mysqli_fetch_array(mysqli_query($con, "SELECT name_product FROM products WHERE id_product=".$id));

    $alreadyHas = mysqli_fetch_all(mysqli_query($con, "SELECT DISTINCT categories.name_category FROM categories_of_products JOIN categories ON categories.id_category = categories_of_products.id_category WHERE id_product =".$id));
    
    $categories = mysqli_fetch_all(mysqli_query($con, "SELECT id_category, name_category FROM categories"));
?>

<div class='titleCreate'>Добавление категории к  : '<?=$nameProd[0]?>' </div>

<div id="allBlocksAddCat">
    <div id="alreadyHasCat">
        <h3>Уже есть</h3>
    <?php
        foreach($alreadyHas as $cat){
            echo "<span class='alCat'>".$cat[0]."</span>";
        }
    ?>
    </div>
    <div id='emtyAboveAcc'> </div>

    <form action='addCatProd-db.php' method='get'>
        <!-- Продукт -->
        <input type="hidden" name="idProd" value='<?=$id?>'>
        <!-- Категория к продукту -->
        <label class='labelCP' for='cat'>Категория</label>
        <select class='inputCP' id="selectCatProd" name='cat' id=''>
            <?php
                foreach($categories as $cat){
                    echo "<option value='".$cat[0]."'>".$cat[1]."</option>";
                }
            ?>
        </select>
        <br>
        <input id='submitCreateProd' type="submit" value="Добавить">
    </form>
</div>
<!-- </div> -->
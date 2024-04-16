<?php
    include "../header.php";
    echo "<div id='emtyAboveAcc'> </div>";
?>

<div class='titleCreate'>Добавление карточки продукта</div>

<form action='createProduct-db.php' method='post' id='formCreateProd'>
    <label class='labelCP' for='name'>Название продукта</label>
    <!-- pattern= '[А-Я]{1}[а-яЁё]{1,18}' -->
        <input class='inputCP' type='text' name='name' required  >
    <label class='labelCP' for='desc'>Описание продукта</label>
        <textarea class='inputCP' name="desc" id="" cols="30" rows="10"  required></textarea>
    <label class='labelCP' for='image' id='image'>Изображение продукта</label>
        <input class='inputCP' type='file' name='image' id='image'  required accept = 'image/png'>
    <br>
    <br>
    <br>
    <label class='labelCP' for='cat'>Одна категория (хотя-бы)</label>
        <select class='inputCP' name="cat" id="selectCatProd"  required>
            <?php
                $categories = mysqli_fetch_all(mysqli_query($con, "SELECT id_category, name_category FROM categories"));
                foreach($categories as $category){
                    echo "<option value='".$category[0]."'>".$category[1]."</option>";
                }
            ?>
        </select>
    <br>
    <br>
    <br>
    <label class='labelCP' for='vol'>Один объем (хотя-бы)</label>
        <input class='inputCP' type='text' name='vol'  required pattern='[0-9]{1,3}.[0-9]{}'>
    <label class='labelCP' for='price'>Одна цена (хотя-бы)</label>
        <input class='inputCP' type='text' name='price'  required>
    <br>
    <br>
    <br>
    <input id='submitCreateProd' type="submit" value="Создать продукт">
</form>
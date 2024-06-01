<?php
    session_start();
    include "../header.php";
    $id = isset($_POST['idProd']) ? $_POST['idProd'] : $_SESSION['id'];

    $infoProd = mysqli_fetch_array(mysqli_query($con, "SELECT id_product, name_product, desc_product, image_product FROM products WHERE id_product =".$id));
    echo "<div id='emtyAboveAcc'> </div>";
    $_SESSION['id'] = $id;
?>


<div class='titleCreate'>Изменение карточки продукта</div>

<div id='updateProd'>
    <form action='updateProd-db.php' method='post' id='formCreateProd'>
        <input type="hidden" name="id" value = '<?=$infoProd[0]?>'>
        <label class='labelCP' for='name'>Название продукта</label>
            <input class='inputCP' type='text' name='name' required value='<?=$infoProd[1]?>'>
        <label class='labelCP' for='desc'>Описание продукта</label>
            <textarea class='inputCPU' name='desc' id='' cols='30' rows='10'  required><?=$infoProd[2]?></textarea>
        <label class='labelCP' for='image' id='image'>Изображение продукта (Предыдущее изображение находится справа)</label>
            <input class='inputCP' type='file' name='image' id='image' accept = 'image/png' value='falses'>
        <br>
        <br>
        <br>
        <input id='submitCreateProd' type='submit' value='Сохранить изменения'>
    </form>
    <div id="updateProdFI">
        <img src="../images/products/<?=$infoProd[3]?>" alt="<?=$infoProd[1]?>" title='Предыдущее изображение'>
    </div>
</div>
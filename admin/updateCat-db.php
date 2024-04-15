<?php
    include "../header.php";
    echo "<div id='emtyAboveAcc'> </div>";
    echo $_POST['idCat'];
    $nameCat = mysqli_fetch_array(mysqli_query($con, "SELECT name_category FROM `categories` WHERE id_category=".$_POST['idCat']));

?>
<h3 id='headerCheckCat'>Изменение названия категории</h3>
<form id='updateCatCheck' action='updateCatCheck-db.php'  method='POST'>
    <label for='nameCat' id='nameCatL'>&nbsp; &nbsp; Название категории
        <input id='checkNameCat' name='nameCat' type="text" value='<?=$nameCat[0]?>'>
    </label>
    <input type="hidden" name='idCat' value='<?=$_POST['idCat']?>'>
    <input id='submitCheckCat' type="submit" value="Изменить">
</form>
<?php
    include "../header.php";
    echo "<div id='emtyAboveAcc'> </div>";
?>

<div class='titleCreate'>Добавление категории</div>

<form action='createCategory-db.php' method='post' id='createCatPage'>
    <input type='text' name='nameCat' id='createCategory' require >
    <input type='submit' value='Создать' class='submitCreate'>
</form>
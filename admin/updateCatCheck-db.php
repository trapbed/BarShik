<?php

    include "../connect-db.php";

    $oldNameCat = mysqli_fetch_array(mysqli_query($con, "SELECT name_category FROM `categories` WHERE id_category=".$_POST['idCat']));

    $newCat = $_POST['nameCat'];

    if($oldNameCat != $newCat){
        $updateCatQuery = mysqli_query($con, "UPDATE categories SET name_category='".$newCat."' WHERE id_category =".$_POST['idCat']);
        echo $updateCatQuery;
        echo "
        <script>alert('Название успешно изменено !');
        location.href = 'index.php?page=categories';</script>
        ";
    }
    else if($oldNameCat == $newCat){
        echo "
        <script>alert('Название актуально !');
        location.href = 'index.php?page=categories';</script>
        ";
    }
    else{
        echo "
        <script>alert('Неизвестная ошибка !Категория не изменена !');
        location.href = 'index.php?page=categories';</script>
        ";
    }

    echo $oldNameCat[0];
    echo $newCat;
?>
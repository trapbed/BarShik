<?php
    session_start();
    include "../connect-db.php"; 

    $idCat = $_POST['idCat'];
    $_SESSION['id_cat'] = $idCat;

    $nameCat = mysqli_fetch_array(mysqli_query($con, "SELECT name_category FROM categories WHERE id_category=".$idCat));
    $check_num_row = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `categories_of_products` WHERE id_category = $idCat"));
    // $check = ($check_num_row>0) ? true : false;

echo "<script>
    let ask= confirm('Вы точно хотите восстановить категорию ".$nameCat[0] ." ?') ;
    if(ask){";
    echo "alert('Категория ".$nameCat[0]." успешно восстановлена !');
        location.href = 'checkCat.php?page=categories&check=true&act=recover';
    }
    else{
        alert('Категория ".$nameCat[0]." все еще является удаленной !');
        location.href = 'checkCat.php?page=categories&check=false&act=recover';
    }
</script>";

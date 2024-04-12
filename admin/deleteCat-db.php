<?php
    session_start();
    include "../connect-db.php"; 

    $idCat = $_POST['idCat'];
    $_SESSION['id_cat'] = $idCat;

    $nameCat = mysqli_fetch_array(mysqli_query($con, "SELECT name_category FROM categories WHERE id_category=".$idCat));

echo "<script>
    let ask= confirm('Вы точно хотите удалить категорию ".$nameCat[0] ." ?') ;
    if(ask){";
    echo "alert('Категория ".$nameCat[0]." успешно удалена ! Все продукты этой категории будут удалены!');
        location.href = 'checkCat.php?page=categories&check=true';
    }
    else{
        alert('Категория ".$nameCat[0]." все еще существует !');
        location.href = 'checkCat.php?page=categories&check=false';
    }
</script>";

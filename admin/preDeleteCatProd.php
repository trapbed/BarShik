<!-- Проверка перед удалением категории к продукту!!! -->

<?php

include "../connect-db.php";


$idProd = $_GET['prod'];
$cat = $_GET['cat'];

?>

<script>
    let check = confirm('Вы действительно хотите удалить отношение категории к продукту?');
    if(check){
        location.href = "deleteCatProd.php?prod=<?=$idProd?>&cat=<?=$cat?>";
    }
    else{
        alert('Продукт все еще относится к категории!');
        location.href='index.php?page=products&prods=products';
    }
</script>
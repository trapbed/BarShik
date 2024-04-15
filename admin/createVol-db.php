<?php

    include "../connect-db.php";

    echo $_GET['idProd'];
    $idProd =  $_GET['idProd'];
    echo "<br>";
    echo $_GET['volume'];
    $volume = $_GET['volume'];
    echo "<br>";
    echo $_GET['price'];
    $price = $_GET['price'];

    $checkVol = mysqli_num_rows(mysqli_query($con, "SELECT * FROM volumes WHERE id_product=".$idProd." AND volume_of_prod=".$volume));
    echo $checkVol;
    if($checkVol == 0){
        $create = mysqli_query($con, "INSERT INTO `volumes` ( `id_product`, `volume_of_prod`, `price_volume`) VALUES (".$idProd.", '".$volume."', '".$price."')"); 
        echo "<script>
        alert('Объем и цена для продукта созданы!');
        location.href='index.php?page=products&prods=volumes';
        </script>";
    }
    else{
        echo "<script>
        alert('Объем и цена для продукта актуальны!');
        location.href='index.php?page=products&prods=volumes';
        </script>";
    }
?>


<!-- SELECT `id_volume_prod`, `id_product`, `volume_of_prod`, `price_volume` FROM `volumes` WHERE id_product=1 AND volume_of_prod=0.33 -->
<!-- INSERT INTO `volumes` (`id_volume_prod`, `id_product`, `volume_of_prod`, `price_volume`) VALUES (NULL, '1', '0.01', '100'); -->
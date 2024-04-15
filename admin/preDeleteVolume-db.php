<?php

    session_start();

    include "../connect-db.php";

    $idRowVol = $_POST['idRowVol'];

    echo $idRowVol;

    $rowVol = "SELECT `id_volume_prod`, products.name_product, `volume_of_prod`, `price_volume` FROM `volumes` JOIN products ON products.id_product=volumes.id_product WHERE id_volume_prod = ".$idRowVol;
    $infoRowVol = mysqli_fetch_array(mysqli_query($con, $rowVol));
    print_r($infoRowVol);

    $_SESSION['rowVol'] = $idRowVol;
    $_SESSION['volume'] = $infoRowVol[2];
    $_SESSION['nameProd'] = $infoRowVol[1];
?>

<script>
    let check = confirm("Вы дейтвительно хотите удалить объем <?=$infoRowVol[2]?> для продукта '<?=$infoRowVol[1]?>'?");
    if(check){
        location.href = "deleteVolume-db.php";
    }
    else{
        location.href = "index.php?page=products&prods=volumes";
    }
</script>
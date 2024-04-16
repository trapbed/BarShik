<?php

    include "../connect-db.php"; 

    $idRow = $_GET['idRow'];
    $newVol = $_GET['volume'];
    $newPrice = $_GET['price'];

    $qRow = mysqli_fetch_array(mysqli_query($con, "SELECT volume_of_prod, price_volume FROM volumes WHERE id_volume_prod =".$idRow));
    echo $qRow[0];
    echo $newVol;
    echo "<br>";
    echo $qRow[1];
    echo $newPrice;
    $checker = false;

    if($newVol != $qRow[0] || $newPrice != $qRow[1]){
        $qUpdate = "UPDATE volumes SET ";
        if($newVol != $qRow[0]){
            $qUpdate .= "volume_of_prod=".$newVol;
            $checker = true;
        }
        if($newPrice != $qRow[1]){
            if($checker == true){
                $qUpdate .= " , ";
            }
            $qUpdate .= " price_volume=".$newPrice;
        }
        $qUpdate .= " WHERE id_volume_prod =".$idRow;
        
        $qUpdate = mysqli_query($con, $qUpdate);

        echo "<script>
            alert('Объем успешно изменен !');
            location.href = 'index.php?page=products&prods=volumes';

        </script>";
    }
    else{
        echo "<script>
            alert('Объем актуален !');
            location.href = 'index.php?page=products&prods=volumes';

        </script>";
    }
?>
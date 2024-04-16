<?php

    include "../header.php";
    echo "<div id='emtyAboveAcc'> </div>";

    $idRowVol =  $_POST['idRowVol'];

    $rowVolQ = mysqli_fetch_array(mysqli_query($con, "SELECT products.image_product, products.name_product, volume_of_prod, price_volume FROM volumes JOIN products ON products.id_product=volumes.id_product WHERE id_volume_prod =".$idRowVol));

    // print_r($rowVolQ);
    echo "<div id='imgDescVolCreate'>";

    echo "<div id='infoProdForVol'> <h3 class='titleCreate'>Изменение объема для '".$rowVolQ[1]."'</h3>
    <img id='imgProdForVol' src='../images/products/".$rowVolQ[0]."' alt='".$rowVolQ[1]."'></div>";


    
    echo "<div id='forVolumesU'>
    <h3 class='hasAlready'>Форма добавления</h3>
    <form method='GET' action='updateVolume-db.php' id='formUpdateVol'>
        <input type='hidden' name='idRow' value='".$_POST['idRowVol']."'>
        <label class='label' for='volume'>Объем</label>
        <input name='volume' class='inputCreateVol' type='text' placeholder = 'Обьем' pattern='([0-9]{1,3}).([0-9]{1,2})' value='".$rowVolQ[2]."' required>
        <label class='label' for='price'>Цена</label>
        <input name='price' class='inputCreateVol' type='text' placeholder = 'Цена' value='".$rowVolQ[3]."' required>
        <input id='submitCreateVol' type='submit' value='Создать'>
    </form>";

    echo "</div>
    </div>";
?>
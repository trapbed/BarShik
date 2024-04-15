<?php
    include "../header.php";
    echo "<div id='emtyAboveAcc'> </div>
    <div id='imgDescVolCreate'>";
    // echo $_POST['idProd'];

    $imgName = mysqli_fetch_array(mysqli_query($con, "SELECT `name_product`,`image_product` FROM `products` WHERE id_product =".$_POST['idProd']));


    echo "<div id='infoProdForVol'> <h3 class='titleCreate'>Добавление объема к : '".$imgName[0]."'</h3>
    <img id='imgProdForVol' src='../images/products/".$imgName[1]."' alt='".$imgName[0]."'></div>";

    $volQ = mysqli_fetch_all(mysqli_query($con, "SELECT volume_of_prod, price_volume FROM `volumes` JOIN products ON products.id_product=volumes.id_product WHERE volumes.id_product=".$_POST['idProd']));

    echo "<div id='forVolumes'>";
    // echo "<table>";
    echo  "<div id='forHasAlready'>";
    echo "<span class='hasAlready'>Уже есть</span>";
    echo "<table>
            <tr>
            <td class='volOneRow'>Объем</td>
            <td class='priceOneVol'>Цена</td>
            </tr>
        </table>
        <br>";
    foreach($volQ as $vol){
        echo "<table>
        <tr>
        <td class='volOneRow'>".$vol[0]."</td>
        <td class='priceOneVol'>".$vol[1]." &#8381;</td>
        </tr>
        </table>";
    }
    echo "</div>";

    echo "<div id='forFormCreateVol'>
    <h3 class='hasAlready'>Форма добавления</h3>
    <form method='GET' action='createVol-db.php' id='formCreateVol'>
        <input type='hidden' name='idProd' value='".$_POST['idProd']."'>
        <input name='volume' class='inputCreateVol' type='text' placeholder = 'Обьем' pattern='([0-9]{1,3}).([0-9]{1,2})' required>
        <input name='price' class='inputCreateVol' type='text' placeholder = 'Цена' required>
        <input id='submitCreateVol' type='submit' value='Создать'>
    </form>

    </div>";

    echo "</div>";
?>


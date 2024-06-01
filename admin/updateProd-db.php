<?php

include "../connect-db.php"; 

$id = isset($_POST['id']) ? $_POST['id'] : false;
$old = mysqli_fetch_array(mysqli_query($con, "SELECT id_product, name_product, desc_product, image_product FROM products WHERE id_product =".$id));
$newName = isset($_POST['name']) ? $_POST['name'] : false;
$newDesc = isset($_POST['desc']) ? $_POST['desc'] : false;
$newImg = isset($_POST['image']) ? $_POST['image'] : 'falses';
$alert = '';

echo $_FILES['image'];
// echo $old[3];
// echo $newImg;

$updateProd = "UPDATE products SET ";
$check = false;
if($old[1] != $newName || $old[2] != $newDesc || $old[3] != $newImg){
    if( $old[1] != $newName ){
        if($check == true){
            $updateProd .= " , ";
        }
        $updateProd .= " name_product = '".$newName."' ";
        $check = true;
    }
    if( $old[2] != $newDesc ){
        if($check == true){
            $updateProd .= " , ";
        }
        $updateProd .= " desc_product = '".$newDesc."' ";
        $check = true;
    }
    if( $old[3] != $newImg && $newImg != 'false'){
        if($check == true){
            $updateProd .= " , ";
        }
        $updateProd .= " image_product = '".$newImg."' ";
        $check = true;
    }
    $updateProd .= " WHERE id_product = ".$id;
    echo $updateProd;
}
else{
    $alert = "Данные актуальны!";
}


?>
<!-- SET `id_product`='[value-1]',`name_product`='[value-2]',`desc_product`='[value-3]',`image_product`='[value-4]' WHERE 1 -->
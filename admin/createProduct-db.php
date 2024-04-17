<?php
    include "../connect-db.php"; 

    // CREATE PRODUCT
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $img = $_POST["image"];
    // ADD CAT
    $cat = $_POST['cat'];
    // ADD VOLUME
    $vol = $_POST['vol'];
    $price = $_POST['price'];

    // echo $img;

    // $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `products` WHERE name_product = '".$name."'"));
    
    // if($check == 0){







        $queryInsert = mysqli_query($con, "INSERT INTO products (name_product, desc_product, image_product) VALUES ('".$name."','".$desc."','".$img."')");
        $id = mysqli_insert_id($con);
        // move_uploaded_file($img['name'], "../images/products/".$img['name'].")");
        move_uploaded_file($img, "../images/products/".$img."");

        echo "
        <script>
            location.href = 'createProdCV-db.php?cat=".$cat."&vol=".$vol."&price=".$price."&id=".$id."';
        </script>";







    // }
    // else{
    //     echo "
    //     <script>
    //         alert('Продукт с таким названием уже существует');
    //         location.href='index.php?page=products&prods=products';
    //     </script>";
    // }
    // echo $_POST[''];

    // INSERT INTO products (name_product, desc_product, image_product) VALUES ('','','','')
?>
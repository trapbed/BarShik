<?php
    include "../connect-db.php"; 

    $id = $_GET['id'];
    $cat = $_GET['cat'];
    $vol = $_GET['vol'];
    $price = $_GET['price'];

    $queryCat = mysqli_query($con, "INSERT INTO categories_of_products (id_product, id_category) VALUES (".$id.",".$cat.")");
    $queryVol = mysqli_query($con, "INSERT INTO volumes(id_product, volume_of_prod, price_volume) VALUES (".$id.",".$vol.",".$price.")");

    echo "
    <script>
        alert('Добавлен продукт, категории и объем к нему!!!');
        location.href='index.php?page=products&prods=products';
    </script>";
?>
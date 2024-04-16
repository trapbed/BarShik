<?php

    include "../connect-db.php";

    $available = mysqli_num_rows(mysqli_query($con, "SELECT DISTINCT  id_product, id_category FROM categories_of_products WHERE id_category =".$_GET['cat']." AND id_product =".$_GET['idProd']));

    if($available == 0){
        $queryInsert = mysqli_query($con, "INSERT INTO categories_of_products (id_product, id_category) VALUES (".$_GET['idProd'].",".$_GET['cat'].")");
        echo  "
        <script>
            alert('Категория успешно добавлена!!!');
            location.href = 'index.php?page=products&prods=products';
        </script>
        ";
    }
    else{
        echo  "
        <script>
            alert('Категория уже имеется для продукта!!!');
            location.href = 'index.php?page=products&prods=products';
        </script>
        ";
    }

?>
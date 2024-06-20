<?php

    include "../connect-db.php"; 

    $id = $_GET['id'];

    $deleteProd = mysqli_query($con, "UPDATE `products` SET `exist` = '1' WHERE `products`.`id_product` = ".$id);

    $name = mysqli_fetch_array(mysqli_query($con, "SELECT name_product FROM `products` WHERE id_product =".$id));

?>

<script>
    alert("Продукт '<?=$name[0]?>' восстановлен!");
</script>
<?php
    echo "
    <script>
        location.href = 'index.php?page=products&prods=products';
    </script>
    ";
?>
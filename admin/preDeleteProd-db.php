<?php

    include "../connect-db.php"; 

    $id = $_POST['idProd'];

    $name = mysqli_fetch_array(mysqli_query($con, "SELECT name_product FROM `products` WHERE id_product =".$id));
    echo $id;

?>

<script>
    let check = confirm("Вы действительно хотите удалить продукт : '<?=$name[0]?>'");
    if(check){
        location.href = "deleteProd-db.php?id=<?=$id?>";
    }
    else{
        alert("Продукт '<?=$name[0]?>' все еще существует!");
        location.href='index.php?page=products&prods=products';
    }
</script>
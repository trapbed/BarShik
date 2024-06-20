<?php

    include "../connect-db.php"; 

    $id = $_POST['idProd'];

    $name = mysqli_fetch_array(mysqli_query($con, "SELECT name_product FROM `products` WHERE id_product =".$id));
    echo $id;

?>

<script>
    let check = confirm("Вы действительно хотите восстановить продукт : '<?=$name[0]?>'");
    if(check){
        location.href = "recoverProd-db.php?id=<?=$id?>";
    }
    else{
        alert("Продукт '<?=$name[0]?>' все еще является удаленным!");
        location.href='index.php?page=products&prods=products';
    }
</script>
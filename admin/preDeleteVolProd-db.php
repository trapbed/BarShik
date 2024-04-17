<?php
    include "../connect-db.php"; 

    $id = $_GET['id'];
    
    $name = mysqli_fetch_array(mysqli_query($con, "SELECT id_volume_prod, products.name_product, volume_of_prod, price_volume FROM volumes JOIN products ON products.id_product=volumes.id_product WHERE id_volume_prod =".$id));
?>

<script>
    let check = confirm("Вы действительно хотите удалить объем: '<?=$name[2]?>' для продукта : '<?=$name[1]?>'");

    if(check){
        location.href = "deleteVolProd.php?id=<?=$name[0]?>";
    }
    else{
        alert('Объем все еще существует!');
        location.href = "index.php?page=products&prods=products";
    }
</script>
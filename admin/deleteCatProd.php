<?php

include "../connect-db.php";

$queryDelCatProd = mysqli_query($con, "DELETE FROM categories_of_products WHERE id_product =".$_GET['prod']." AND id_category =".$_GET['cat']);

?>
<script>
    alert('Отношение продукта к категории удалено !');
    location.href = 'index.php?page=products&prods=products';
</script>
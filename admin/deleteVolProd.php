<?php

include "../connect-db.php"; 

$id = $_GET['id'];

$query = mysqli_query($con, "DELETE FROM `volumes` WHERE id_volume_prod =".$id)

?>

<script>
    alert('Объем успешно удален!');
    location.href = "index.php?page=products&prods=products";
</script>
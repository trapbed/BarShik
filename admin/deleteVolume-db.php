<?php

    include "../connect-db.php";

    session_start();
    
    $queryDeleteVol = mysqli_query($con, "DELETE FROM `volumes` WHERE id_volume_prod =".$_SESSION['rowVol']);

    // $_SESSION['rowVol'];
    // $_SESSION['volume'];
    // $_SESSION['nameProd'];

?>

<script>
    alert("Вы удалили объем <?=$_SESSION['volume']?> для <?=$_SESSION['nameProd']?> ");
    location.href = 'index.php?page=products&prods=volumes';
</script>
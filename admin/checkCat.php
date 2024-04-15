<?php
    session_start();
    include "../connect-db.php"; 

// echo $_SESSION['id_cat'];
    if($_GET['check'] == 'true'){
        $delete = mysqli_query($con, "DELETE FROM categories WHERE id_category =".$_SESSION['id_cat']);
    }
    echo "
        <script>
            location.href='index.php?page=categories';
        </script>
        ";
?>
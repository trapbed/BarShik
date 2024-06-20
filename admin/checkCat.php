<?php
    session_start();
    include "../connect-db.php"; 

// echo $_SESSION['id_cat'];
    if($_GET['act'] == 'delete'){
        if($_GET['check'] == 'true'){
            $delete = mysqli_query($con, "UPDATE `categories` SET `exist` = '0' WHERE `categories`.`id_category` = ".$_SESSION['id_cat']);
        }
        echo "
            <script>
                location.href='index.php?page=categories';
            </script>
        ";}
    if($_GET['act'] == 'recover'){
        if($_GET['check'] == 'true'){
            $delete = mysqli_query($con, "UPDATE `categories` SET `exist` = '1' WHERE `categories`.`id_category` = ".$_SESSION['id_cat']);
        }
        echo "
            <script>
                location.href='index.php?page=categories';
            </script>
        ";
    }
?>
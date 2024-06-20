<?php
    
    session_start();
    require_once("../connect-db.php");
    print_r($_GET);
    $id_order = isset(  $_GET["id_order"] ) ? $_GET["id_order"] : false;
    $status = isset(  $_GET["status"] ) ? $_GET["status"] : false;
    $check_old_stsatus = mysqli_fetch_array( mysqli_query( $con,"SELECT status_order FROM orders WHERE id_order=".$id_order) )[0];
    if($id_order && $status){
        if( $check_old_stsatus == $status ){
            $_SESSION['mess'] = "Статус актуален!";
            header("Location: ../admin/index.php");
        }
        else{
            $query_change = mysqli_query($con, "UPDATE `orders` SET `status_order` = '$status' WHERE `orders`.`id_order` =".$id_order);
            if($query_change){
                $_SESSION['mess'] = "Статус изменен!";
                header("Location: ../admin/index.php");
            }
            else{
                $_SESSION['mess'] = "Не удалось изменить статус!";
                header("Location: ../admin/index.php");
            }
        }
    }
    else{
        $_SESSION['mess'] = "Выберите статус";
        header("Location: ../admin/index.php");
    }
?>
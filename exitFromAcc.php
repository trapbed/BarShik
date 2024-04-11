<?php
    session_start();
    echo "<script>
                let exit = confirm('Вы хотите выйти из аккаунта?');
                if(exit){
                        alert('Вы вышли из аккаунта!');
                        location.href = '../catalog.php';
                }
                else{
                        location.href = '../catalog.php';
                        exit();
                }
        </script>";
        unset($_SESSION['id_user']);
?>
<?php
    session_start();
    include "../connect-db.php";
    $login = $_POST['email'];
    $pass = $_POST['pass'];

    $checkLogin = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email_user='".$login."'"));
    // echo $checkLogin;

    if($checkLogin !== 0 ){
        $error = 'Пользователь с такой почтой уже существует!';
    }else{
        $queryInsert = mysqli_query($con, "INSERT INTO users( email_user, password_user) VALUES ('".$login."','".$pass."')");
        $error = 'Вы успешно зарегистрированны!';
        $_SESSION['id_user'] = mysqli_insert_id($con);
    }

        echo "<script>
            alert('".$error."');
            location.href = '../catalog.php';
        </script>";

?>
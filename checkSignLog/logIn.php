<?php
    include "../connect-db.php";
    session_start();

    $login = $_POST['email'];
    $pass = $_POST['pass'];

    $error = '';

    $user = "SELECT id_user, email_user, password_user FROM users";
    
    $user_id = mysqli_fetch_array(mysqli_query($con, "SELECT id_user FROM users WHERE email_user= '".$login."' AND password_user='".$pass."'"));

    $user_login = $user." WHERE email_user='".$login."'";
    $check_login = mysqli_num_rows(mysqli_query($con, $user_login));
    $user_pass = $user." WHERE password_user='".$pass."'";
    $check_pass = mysqli_num_rows(mysqli_query($con, $user_pass));

    $location = '../catalog.php';

    if($check_login == 0){
        $error = ' Неправильно введен Логин. Проверьте и попробуйте снова.';
    }
    if($check_pass == 0){
        $error = 'Неверный пароль. Проверьте и попробуйте снова.';
    }
    if($check_login == 0 && $check_pass == 0){
        $error = 'Такого пользователя не существует.';
    }
    if($check_login != 0 && $check_pass != 0){
        $checkAdmin = mysqli_fetch_array(mysqli_query($con, "SELECT admin_status FROM users WHERE id_user =".$user_id['id_user']));
        if($checkAdmin['admin_status'] == 1){
            $location = '../admin/index.php?page=users';
        }else{
            $location = '../account.php';
        }
        $error = 'Вы успешно вошли в аккаунт';
        $_SESSION['id_user'] = $user_id['id_user'];
        echo $location;
        // echo $user_id;
    }

    echo "<script>
    alert('$error');
    location.href = '".$location."';
    </script>";
?>


<!-- mysqli_fetch_all(mysqli_query($con,    ))-->
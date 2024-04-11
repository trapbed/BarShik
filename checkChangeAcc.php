<?php
    session_start();
    include "connect-db.php";
    $id_user = $_SESSION['id_user'];

    $email =  isset($_POST['email']) ? $_POST['email'] : false;
    $pass = isset($_POST['pass']) ? $_POST['pass'] : false;

    $userInfo = mysqli_fetch_array(mysqli_query($con, "SELECT id_user, email_user, password_user, bonuses_active, admin_status FROM users WHERE id_user=".$id_user));
    // print_r($userInfo);

    echo $email;
    echo $userInfo['email_user'];

    echo "<hr>";

    echo $pass;
    echo $userInfo['password_user'];

    if($email != $userInfo['email_user'] || $pass != $userInfo['password_user']){
        $alert = "Вы изменили свои данные : ";

        $query = "UPDATE users SET ";
        $checkComma = false;

        if($email != $userInfo['email_user']){
            if($checkComma == true){
                $query .= ', ';
                $alert .= ' и ';
            }
            $query .= " email_user = '".$email."'";
            $checkComma = true;
            $alert .= "логин с ".$userInfo['email_user']." на ".$email."";
        }

        if($pass != $userInfo['password_user']){
            if($checkComma == true){
                $query .= ', ';
                $alert .= ' и ';
            }
            $query .= " password_user = '".$pass."'";
            $checkComma = true;
            $alert .= "пароль с ".$userInfo['password_user']." на ".$pass."";
        }
        $query .= " WHERE id_user =".$id_user;
        $query = mysqli_query($con, $query);
    }
    else{
        $alert = 'Данные актуальны !';
    }

?>
<script>
    let check = alert('<?= $alert ?>');
    location.href='account.php';
</script>


<!-- UPDATE `users` SET `email_user` = 'diamond@mail.comm', `password_user` = 'diamondm' WHERE `users`.`id_user` = 1; -->


<!--[0] => 1                        [id_user] => 1 
    [1] => diamond@mail.com         [email_user] => diamond@mail.com 
    [2] => diamond                  [password_user] => diamond 
    [3] => 0                        [bonuses_active] => 0 
    [4] => 1                        [admin_status] => 1 -->
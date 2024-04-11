<?php
    include "header.php";
?>

<div id="emtyAboveAcc"></div>

<?php
echo "<h3 id='changeAccH3'> Смена данных аккаунта </h3>";
 echo "
 <form action='checkChangeAcc.php' method='POST' id='modalAcc'>
     <label class='labelAcc' for='email'> Логин :
     <input class='input' type='text' name='email' value='".$userInfo['email_user']."' required pattern='([A-z0-9_.]{1,})@([A-z]{1,}).([A-z]{2,8})'></label>
     <label class='labelAcc' for='pass'> Пароль :
     <input class='input' type='text' name='pass' value='".$userInfo['password_user']."' required></label>
     <input id='submitModal' type='submit' value='Сохранить'>
 </form>";
?>
<?php
    $allUsers = mysqli_fetch_all(mysqli_query($con, "SELECT `email_user`, `bonuses_active`, `admin_status`, `blocked` FROM `users`"));
    echo "<table id='usersAdminTable'>
    <thead id='usersAdmin'>
        <td id='loginAdminUserH'>Логин</td>
        <td id='bonusesAdminUserH'>Количество бонусов</td>
        <td id='statusAdminUserH'>Статус(админ)</td>
        <td id='blockedAdminUserH'>Статус(Блок.)</td>
        <td id='actionAdminUserH'>Действия</td>
    </thead>";
    foreach($allUsers as $oneUser){
        echo "<tr>
            <td class='loginAdminUser'>".$oneUser[0]."</td>
            <td class='bonusesAdminUser'>".$oneUser[1]."</td>";
            if($oneUser[2] == 1){
                echo "<td class='statusAdminUserA'>Админ</td>";
            }else{
                echo "<td class='statusAdminUserB'>Покупатель</td>";
            }
            
            if($oneUser[3] == 1){
                echo "<td class='statusAdminUserUS'>Заблокирован</td>";
            }else{
                echo "<td class='statusAdminUserBS'>Действителен</td>";
            }
            echo "</td>
            <td class='actionAdminUser'> <form action='' method='POST'>
                                            <input type='hidden' value=''>
                                            <input type='submit' value='";
                                            if($oneUser[3]==0){
                                                echo "Заблокировать' class='userBlocked'>";
                                            }
                                            else{
                                                echo "Разблокировать' class='userUnblocked'>";
                                            }
                                            echo "
                                        </form> </td>
        </tr>";
    }

    echo "</table>";
?>
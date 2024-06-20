<?php
    include "../connect-db.php"; 

    session_start();
    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false; 
    if($id_user != false){
        $userInfo = mysqli_fetch_array(mysqli_query($con, "SELECT id_user, email_user, password_user, admin_status FROM users WHERE id_user=".$id_user));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

</head>
<body id='catalogNav'>

<?php
    include "../modalAcc.php";
?>


    <nav>
        <div id='forNav'>
            <form action="" method="get" id='searchFormNav'>
                <input type="text" name="search" id="searchNav" placeholder='Хочу найти..'>
                <input id='searchNavImg' type="submit" id="" value=''>
            </form>
            <a href='../catalog.php' class='fizzBackWord' id='logo'>fizz</a>
            <div id='navThreeDivsAdmin'>
                <?php
                    if($id_user != false){
                        echo "
                        <a class='adminNav' href='index.php?page=stat'>Статистика</a>
                        <a class='adminNav' href='index.php?page=orders'>Заказы</a>
                        <a class='adminNav' href='index.php?page=categories'>Категории</a>
                        <a class='adminNav' href='index.php?page=products&prods=products'>Продукты</a>
                        <a href='/account.php' id='userEmailNav'>".$userInfo['email_user']."</a>
                        <a href='../exitFromAcc.php' id='logOut' >Выйти</a>";
                    }
                    else{
                        echo "<button id='logIn' >Войти</button>";
                    }

                ?>

            </div>
        </div>
        
    </nav>
    <?php
    $s1 = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : false;
    $s2 = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : false;
    $s3 = isset($_SERVER['QUERY_STRING'])? "?".$_SERVER['QUERY_STRING'] : false;

    $sLast = $s1.$s2.$s3;
    $s23 = $s2.$s3;
    echo $sLast;
    // print_r($_SERVER);
    ?>
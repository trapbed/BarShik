<?php
session_start();
include "connect-db.php"; 

    $bonuses_active = 0;
    $count_cart = 0;

    if(isset($_SESSION["id_user"])){
        $minus_bonus = mysqli_fetch_all(mysqli_query($con,"SELECT bonus_minus FROM orders WHERE id_user =".$_SESSION['id_user']));
        $plus_bonus = mysqli_fetch_all(mysqli_query($con, 'SELECT bonus_plus FROM orders WHERE id_user ='.$_SESSION['id_user']));
        foreach($plus_bonus as $plus){
            $bonuses_active += $plus[0];
        }
        foreach($minus_bonus as $minus){
            $bonuses_active -= $minus[0];
        }

        $query_cart = mysqli_query($con, "SELECT into_cart FROM cart WHERE id_user =".$_SESSION['id_user']);
        $count_row_cart = mysqli_num_rows($query_cart);
        if($count_row_cart > 0){
            $into_cart = mysqli_fetch_array($query_cart)[0];
            $into_cart = (array) json_decode($into_cart);
            foreach($into_cart as $prod=>$amount){
                $count_cart += $amount;
            }
        }
    }

    
// echo $count_cart;
    
    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false; 
    if(isset($_SESSION['mess'])){
        echo "<script>
            alert('".$_SESSION['mess']."');
        </script>";
        unset($_SESSION['mess']);
    }
    if($id_user != false){
        $userInfo = mysqli_fetch_array(mysqli_query($con, "SELECT id_user, email_user, password_user, id_user, admin_status FROM users WHERE id_user=".$id_user));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body id='catalogNav'>

<?php
    include "modalAcc.php";
?>


    <nav>
        <div id='forNav'>
            <form action="" method="get" id='searchFormNav'>
                <input type="text" name="search" id="searchNav" placeholder='Хочу найти..'>
                <input id='searchNavImg' type="submit" id="" value=''>
            </form>
            <a href='../catalog.php' class='fizzBackWord' id='logo'>fizz</a>
            <div id='navThreeDivs' <?= $id_user!=false ? "style='width: 35vmax;'" : '' ?>>
                <?php
                    if($id_user != false){
                        echo "
                        <a href='../account.php?page=cart' class='infoAccNav'><img src='../images/ruble.png' alt='ruble' id='ruble'> <span>".$bonuses_active."</span></a>
                        <a href='../account.php?page=cart' class='infoAccNav'><img src='../images/shopBasket.png' alt='basket' id='basket'> <span>".$count_cart."</span></a>
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

    echo $sLast;
    // $_SESSION['']
    // print_r($_SERVER);
    ?>
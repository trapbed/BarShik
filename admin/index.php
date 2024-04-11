<?php
    include "header.php";
    echo "<div id='emtyAboveAcc'> </div>";
    $page = isset($_GET['page']) ? $_GET['page']  : false ;

    if(($_GET['page']) == 'categories'){
        echo "<h3 id='namePageAdmin'> Категории </h3>";
    }
    else if(($_GET['page']) == 'products'){
        echo "<h3 id='namePageAdmin'> Продукты </h3>";
    }
    else{
        echo "<h3 id='namePageAdmin'> Заказы </h3>";
    }

    echo "<div id='scrollAdmin'>";

    if(($_GET['page']) == 'categories'){
        $categories = mysqli_fetch_all(mysqli_query($con, "SELECT `id_category`, `name_category` FROM `categories`"));
        $checkCat = 0;
        echo "<table><thead> 
                    <td></td>
                    <td></td>
                </thead>";
            foreach($categories as $cat){
                if($checkCat == 0){
                    echo "<tr>";
                    $checkCat = 1;
                }
                    echo "<td>".$cat[0]."</td>
                    <td>".$cat[1]."</td>";
                if($checkCat == 1){
                    echo "</tr>";
                    $checkCat = 0;
                }
            }
        echo "";
    }
    else if(($_GET['page']) == 'products'){
        echo "";
    }
    else if(($_GET['page']) == 'orders'){
        

    }



    echo "</div>";
?>
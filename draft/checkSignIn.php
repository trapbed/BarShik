<?php
    include "../connect.php";

    
?>





<?php

    include "../connect-db.php"; 

    $idCat = $_POST['idCat'];
    $nameCat = mysqli_fetch_all(mysqli_query($con, "SELECT name_category FROM categories WHERE id_category=".$idCat));

    // echo

echo "<script>
        let ask = confirm('Вы уверенны что хотите удалить категорию '".$nameCat[0][0]."'?');

        if(ask){
            alert('Категория '".$nameCat[0][0]."' успешно удалена !');
            location.href = 'index.php?page=categories';
        }
        else{
            alert('Категория '".$nameCat[0][0]."' все еще существует !');
            location.href = 'index.php?page=categories';
        }
        </script>";
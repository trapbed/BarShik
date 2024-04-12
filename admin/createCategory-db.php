<?php
    include "../connect-db.php"; 

    $newCat = $_POST['nameCat'];
    $checkBefore = mysqli_fetch_all(mysqli_query($con, "SELECT name_category FROM categories"));
    $checkExist = false;

    foreach($checkBefore as $cat){
        if($cat[0] == $newCat){
            $checkExist = true;
        }
    }
    if($checkExist == false){
        $createCat = mysqli_query($con, "INSERT INTO categories(name_category) VALUES ('".$newCat."')");
        echo "
            <script>
                alert('Категория создана!');
                location.href = 'index.php?page=categories';
            </script>
            ";
    }
    else{
        echo "
            <script>
                alert('Такая категория уже существует!');
                location.href = 'index.php?page=categories';
            </script>
        ";
    }
?>
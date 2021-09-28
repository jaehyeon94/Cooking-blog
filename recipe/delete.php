<?php
    include "../dbconn.php";
    $delete = $_GET['delete'];
    $recipe = $_GET['recipe'];
    $menu = $_GET['menu'];



    $sql = "delete from food where food_no = '$delete'";
    mysqli_query($connect,$sql);
    mysqli_close();

    if($recipe == 'my') {
        echo "
    <script>
        location.href='./myrecipelist.php?menu=$menu';
    </script>";
    } else {
        echo"
    <script>
        location.href='./cooking_main.php?menu=$menu';
    </script>";
    }
?>
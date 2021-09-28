<?php
include "../dbconn.php";
$comment_no = &$_GET['comment_no'];
$food_no = $_GET['food_no'];
$menu = $_GET['menu'];

$recipe = $_GET['recipe'];



$sql = "delete from comment where comment_no = '$comment_no'";
mysqli_query($connect,$sql);
mysqli_close();

if($recipe == 'my') {
    echo "
    <script>
        location.href='../recipe/myrecipe.php?food_no=$food_no&menu=$menu';
    </script>";
} else {
    echo"
    <script>
        location.href='../recipe/recipe.php?food_no=$food_no&menu=$menu';
    </script>";
}
?>
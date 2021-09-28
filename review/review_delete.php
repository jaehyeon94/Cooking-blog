<?php
include "../dbconn.php";

$review_no = $_GET['review_no'];
$menu= $_GET['menu'];
$food_no = $_GET['food_no'];
$sql = "delete from review where review_no = $review_no";
mysqli_query($connect,$sql);
mysqli_close();

echo "
    <script>
        window.close();
        location.href='./reviewlist.php?food_no=$food_no&menu=$menu';
    </script>";

?>
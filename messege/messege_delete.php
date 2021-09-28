<?php
include "../dbconn.php";

$menu = $_GET['menu'];
$messege_no = $_GET['messege_no'];

$sql = "delete from $menu where messege_no = $messege_no";
mysqli_query($connect,$sql);
mysqli_close();

    echo "
    <script>
        window.close();
        opener.parent.location='./messege_main.php?menu=$menu';
    </script>";
?>
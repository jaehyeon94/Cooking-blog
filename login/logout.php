<?php
session_start();

unset($_SESSION['userid']);
unset($_SESSION['usernick']);


echo ("
    <script>
    location.href='../main/main.php';
    window.alert('로그아웃 되었습니다.');
    </script>");
?>
<meta charset="UTF-8">

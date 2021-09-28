<?php
session_start();
?>
<meta charset="UTF-8">
<?php

$id = $_POST["id"];
$pass = $_POST["pass"];

if(!$id) {
    echo("
        <script>
            window.alert('아이디를 입력하세요.')
            history.go(-1);
         </script>
        ");
    exit;
}

if(!$pass) {
    echo("
        <script>
            window.alert('비밀번호를 입력하세요.')
            history.go(-1)
            </script>
            ");
    exit;
}

include "../dbconn.php";

$sql="select * from member where id='$id'";
$result = mysqli_query($connect,$sql);
$num_match = mysqli_num_rows($result);



if(!$num_match) {
    echo ("
        <script> 
            window.alert('아이디가 존재하지 않습니다.')
            history.go(-1)
        </script>
        ");
}
else {
    $row = mysqli_fetch_array($result);
    $db_id = $row[id];
    $db_pass = $row[pass];

    if ($pass != $db_pass || $id != $db_id) {
        echo("
                <script> 
                window.alert('아이디와 비밀번호가 틀렸습니다.')
                history.go(-1)
                </script>
        ");
        exit;
    } else {
        $userid = $row[id];
        $usernick = $row[nick];

        $_SESSION['userid'] = $userid;
        $_SESSION['usernick'] = $usernick;

        echo("
        <script>
            location.href='../main/main.php';
        </script>
            ");
    }
}
?>

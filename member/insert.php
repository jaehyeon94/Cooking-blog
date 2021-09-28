<meta charset="UTF-8">
<?php

    include "../dbconn.php";
    $id = $_POST["id"];
    $pass = $_POST["pass"];
    $nick = $_POST["nick"];
    $mail = $_POST["mail"];

    $sql="select * from member where id ='$id'";
    $result = mysqli_query($connect, $sql);
    $exist_id = mysqli_num_rows($result);

    if($exist_id) {
        echo ("
           <script>
                 window.alert('해당아이디가 존재합니다.')
                history.go(-1)
           </script>
           ");
        exit;
    }
    else {

        $sql = "insert into member(id,pass,nick,mail)";
        $sql .= " values ('$id','$pass','$nick','$mail')";

        mysqli_query($connect,$sql);
    }
    mysqli_close($connect);

        echo ("
         <script>
        window.alert('회원가입이 완료되었습니다.')
        location.href='../main/main.php';
        </script>
    ");

?>
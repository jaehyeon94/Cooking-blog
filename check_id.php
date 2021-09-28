<meta charset="EUC-KR">
<?php
    if(!$id) {
        echo("아이디를 입력하세요.");
    }
    else {
        include "dbconn.php";

        $sql="select * form member where id= $id";

        $result = mysql_query($sql, $connect);
        $num_record=mysql_num_rows($result);

        if($num_record) {
            echo "중복된 아이디가 존재합니다.";
        }
        else {
            echo "사용 가능한 아이디입니다.";
        }
    }

    mysqli_close();
?>
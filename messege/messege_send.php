<?php session_start();
include "../dbconn.php"; // 데이터 베이스 접속 프로그램 불러오기


$id =  $_SESSION['userid'];
$receive = $_GET['receive'];
$title = $_POST['title'];
$messege = $_POST['messege'];
$regist_day=date("Y-m-d (H:i)");


$sql = "insert into send(send,receive,title,messege ,regist_day)";
$sql.= " values ('$id','$receive','$title','$messege','$regist_day')";
$res = $connect->query($sql);

$sql = "insert into receive(send,receive,title,messege ,regist_day)";
$sql.= " values ('$id','$receive','$title','$messege','$regist_day')";

$res = $connect->query($sql);

mysqli_close($connect);
if($res){
    //입력 성공시
    echo("
        <script>
            window.close();
        </script>
            ");
} else{
    echo "fail"; // 디비 입력 실패시 fail표시
}
?>
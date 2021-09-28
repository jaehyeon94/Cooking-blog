<?php
session_start();
include "../dbconn.php"; // 데이터 베이스 접속 프로그램 불러오기


$type = $_POST['food_type'];
$title = $_POST['title'];
$food_no = $_GET['food_no'];
$menu=$_GET['menu'];
$regist_day=date("Y-m-d (H:i)");
$id =  $_SESSION['userid'];

$sql = "select * from member where id = '$id'";
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result);

$nse_content = $connect->escape_string($_POST['ir1']);

$sql = "insert into review(food_no,user_id,name,title,review_content,regist_day)";
$sql .= " values ('$food_no','$id','$row[nick]','$title','$nse_content','$regist_day')";
$res = $connect->query($sql);

mysqli_close($connect);
if($res){
    //입력 성공시
    echo("
        <script>
            location.href='./reviewlist.php?food_no=$food_no&menu=$menu';
        </script>
            ");
} else{
    echo "fail"; // 디비 입력 실패시 fail표시
}
?>
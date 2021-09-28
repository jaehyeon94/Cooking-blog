<?php session_start();
include "../dbconn.php"; // 데이터 베이스 접속 프로그램 불러오기

$food_no = $_GET['food_no'];
$menu=$_GET['menu'];
$comment_day=date("Y-m-d (H:i)");

$id =  $_SESSION['userid'];

$sql = "select * from member where id = '$id'";
$result = mysqli_query($connect,$sql);
$member = mysqli_fetch_array($result);
$nse_content = $connect->escape_string($_POST['ir1']);

$sql = "insert into comment(food_no,user_id,nick,comment,comment_day)";
$sql .= " values ('$food_no','$id','$member[nick]','$nse_content','$comment_day')";
$res = $connect->query($sql);

mysqli_close($connect);
if($res){
    //입력 성공시
    echo("
        <script>
            location.href='../recipe/recipe.php?food_no=$food_no&menu=$menu';
        </script>
            ");
} else{
    echo "fail"; // 디비 입력 실패시 fail표시
}
?>
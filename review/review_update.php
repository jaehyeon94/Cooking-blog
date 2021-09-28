<?php session_start();
include "../dbconn.php";

$review_no = $_GET['review_no'];
$food_no = $_GET['food_no'];
$menu = $_GET['menu'];
$title = $_POST['title'];
$regist_day=date("Y-m-d (H:i)");
$nse_content = $connect->escape_string($_POST['ir1']);


$sql = "update review set title='$title',review_content = '$nse_content',regist_day = '$regist_day' where review_no = '$review_no'";
$result = mysqli_query($connect,$sql);
mysqli_close($connect);
if($result){
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
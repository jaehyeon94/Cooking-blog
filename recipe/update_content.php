<?php session_start();
    include "../dbconn.php";

$food_no = $_GET['food_no'];

for($i = 0 ; $i < 20; $i++) {
    $num[$i] += $i;
}
$i = array_rand($num,1);
$myrecipe = $_GET['myrecipe'];
$type = $_POST['food_type'];
$title = $_POST['title'];
$photo = $_FILES['photo']['name'];


$tmp_name = $_FILES['photo']['tmp_name'];
if(!$photo) {
    $target = 'images/noimg.gif';
    move_uploaded_file($tmp_name,$target);
} else {
    $target_save = '../images/'.$i.$photo;
    $target = 'images/'.$i.$photo;
    move_uploaded_file($tmp_name,$target_save);
}
$regist_day=date("Y-m-d (H:i)");
$nse_content = $connect->escape_string($_POST['ir1']);

if($target == 'images/noimg.gif') {
    $sql = "update food set title='$title',type = '$type',content = '$nse_content',regist_day = '$regist_day' where food_no = '$food_no'";
} else {
    $sql = "update food set title='$title',type = '$type',photo = $target,content = '$nse_content',regist_day = '$regist_day' where food_no = '$food_no'";
}
$result = mysqli_query($connect,$sql);

mysqli_close($connect);
if($result){
    //입력 성공시
    if($myrecipe =='myrecipe') {
        echo("
        <script>
            location.href='./myrecipelist.php?menu=all';
        </script>
            ");
    } else {
        echo("
        <script>
            location.href='./cooking_main.php?menu=all';
        </script>
            ");
    }
} else{
    echo "fail"; // 디비 입력 실패시 fail표시
}
?>
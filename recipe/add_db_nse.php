<?php session_start();
include "../dbconn.php"; // 데이터 베이스 접속 프로그램 불러오기


for($i = 0 ; $i < 20; $i++) {
    $num[$i] += $i;
}
$i = array_rand($num,1);


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
$id =  $_SESSION['userid'];
$sql = "select * from member where id = '$id'";
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result);

$nse_content = $connect->escape_string($_POST['ir1']);

$sql = "insert into food(user_id,name,title,type,photo,content,regist_day)";
$sql .= " values ('$id','$row[nick]','$title','$type','$target','$nse_content','$regist_day')";
$res = $connect->query($sql);

mysqli_close($connect);
if($res){
    //입력 성공시
    echo("
        <script>
            location.href='./myrecipelist.php?menu=all';
        </script>
            ");
} else{
    echo "fail"; // 디비 입력 실패시 fail표시
}
?>
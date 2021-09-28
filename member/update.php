<?php
session_start();
$id = $_SESSION["userid"];
include '../dbconn.php';
for($i = 0 ; $i < 20; $i++) {
    $num[$i] += $i;
}
$i = array_rand($num,1);

$screenshot = $_FILES['screen']['name'];
$pass = $_POST["pass"];
$target = '../images/'.$i.$screenshot;
$target_image = 'images/'.$i.$screenshot;
$tmp_name = $_FILES['screen']['tmp_name'];

move_uploaded_file($tmp_name,$target);

if($pass !="") {
    $update = "update member set pass='$pass' where id = '$id'";
    mysqli_query($connect,$update);
}
if ($screenshot !="") {
    $sql = "update member set photo='$target_image' where id = '$id'";
    mysqli_query($connect,$sql);
}
mysqli_close($connect);
echo("
        <script>
            window.alert('회원수정이 완료되었습니다.')
            location.href='../recipe/myrecipelist.php?menu=all';
        </script>
            ");


?>
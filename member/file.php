<?php
session_start();
include '../dbconn.php';
$id = $_SESSION["userid"];

for($i = 0 ; $i < 20; $i++) {
    $num[$i] += $i;
}
$i = array_rand($num,1);

$screenshot = $_FILES['screen']['name'];
$target = '..images/'.$i.$screenshot;
$target_image = 'images/'.$i.$screenshot;
$tmp_name = $_FILES['screen']['tmp_name'];

move_uploaded_file($tmp_name,$target);


$sql = "update member set photo='$target_image' where id = '$id'";
$result= mysqli_query($connect,$sql);

mysqli_close($connect);
echo ("
         <script type =\"text/javascript\">
            window.close();
        </script>
    ");


?>
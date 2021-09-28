<html>
<head>
    <meta charset="utf-8" />
    <title>쪽지함</title>
    <script type="text/javascript" src="./nse_files/js/HuskyEZCreator.js" charset="utf-8"></script>
    <style>
        .nse_content{width:660px;height:500px}
    </style>
</head>
<body>

<?php
include "../dbconn.php";
$messege_no = $_GET[messege_no];
$menu = $_GET[menu];
    if($menu == 'send') {
        $sql = "select * from send where messege_no = '$messege_no'";
    } elseif ($menu == 'receive') {
        $sql = "select * from receive where messege_no = '$messege_no'";
    }
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result);

    if($menu == 'send') {
        $sql = "select id,nick from member where id ='$row[receive]'";
    } elseif ($menu == 'receive') {
        $sql = "select id,nick from member where id ='$row[send]'";
    }

    $result = mysqli_query($connect,$sql);
    $member = mysqli_fetch_array($result);



mysqli_close();
?>

<script language="javascript">
    function showConfirm() {
        if (confirm("정말 삭제하시겠습니까?"))
        {
            location.href='./messege_delete.php?menu=<?php echo "$menu"?>&messege_no=<?php echo "$messege_no"?>';
        }
    }
</script>



<div align="center">
    <div style="width: 665px; height:690px;">
        <div align="left">
            <h2> 쪽지함 </h2>
        </div>
        <div align="left" style="margin-top: 20px;" >
            <?php
                if($menu == 'send') {
                    echo "<font size=\"4\"> 받는 사람 : </font><font size=\"4\">$member[nick]</font><font size=\"2\">($row[receive])</font><br>";
                } elseif ($menu == 'receive') {
                    echo "<font size=\"4\"> 보낸 사람 : </font><font size=\"4\">$member[nick]</font><font size=\"2\">($row[send])</font><br>";
                }
            ?>
                <font size="4"> 제목 : </font><font size="4"><?php echo "$row[title]"?></font><br>
                <font size="4"> 내용 </font><br>
                <div style="border: 1px solid black; width: 660px; height: 500px"> <font size="4"><?php echo "$row[messege]"?></font>
                </div>
                <div align="right" style="margin-right: 20px ">  <br>
                    <input type="button" value="삭제" onclick="showConfirm()">
                    <input type="button" value="<?php if($menu == 'send') { echo "다시 보내기"; } elseif ($menu == 'receive') { echo "답장 보내기";}?>" style="width: 100px; margin-right: 30px;" onclick="location.href='../messege/messege_form.php?member=<?php echo "$member[id]"?>&my=my'" />
                </div>
        </div>
    </div>
</div>
</body>
</html>
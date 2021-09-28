<html>
<head>
    <meta charset="utf-8" />
    <title>쪽지 보내기</title>
    <script type="text/javascript" src="./nse_files/js/HuskyEZCreator.js" charset="utf-8"></script>
    <style>
        .nse_content{width:660px;height:500px}
    </style>
</head>
<?php
$my = $_GET['my'];
    if("$my == my ") {
        echo "<body onunload=\"opener.document.location.reload()\">";
    } else {
        echo "<body>";
    }

?>

<?php
    include "../dbconn.php";
    $member = $_GET[member];
    $sql ="select * from member where id = '$member'";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);
    mysqli_close();
?>
<div align="center">
    <div style="width: 665px; height:690px;">
        <div align="left">
            <h2> 쪽지 보내기 </h2>
        </div>
        <div align="left" style="margin-top: 20px;" >
            <form name="nse" action="messege_send.php?receive=<?php echo "$row[id]" ?>" method="post">
                <font size="4"> 받는 사람 : </font> <font size="4"><?php echo "$row[nick]"?></font><font size="2">(<?php echo "$row[id]"?>)</font><br>
                <font size="4"> 제목 </font><br><input type="text" style="width: 660px" name="title"> <br>
                <font size="4"> 내용 </font><br><textarea name="messege" id="ir1" class="nse_content" ></textarea>

                <div align="right" style="margin-right: 20px ">  <br>
                    <input type="submit" value="전송" style="width: 100px; margin-right: 30px;" />
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
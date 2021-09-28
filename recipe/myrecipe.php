<?php
include "../member/myprofile.php";
include "../dbconn.php";
$food_no = $_GET['food_no'];
$menu = $_GET['menu'];
$sql = "select * from food where food_no = '$food_no'";
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result);

mysqli_close();
?>
<script language="javascript">
    function showConfirm() {
        if (confirm("정말 삭제하시겠습니까?"))
        {
          location.href = './delete.php?delete=<?php echo "$food_no"?>&recipe=my&menu=<?php echo "$menu"?>';
        }
    }
    }
</script>
<div id = "menu" align="center">
    <ul>
        <li> <a href="myrecipelist.php?menu=all"> 전체 </a></li>
        <li> <a href="myrecipelist.php?menu=simple"> 간단한 요리 </a></li>
        <li> <a href="myrecipelist.php?menu=Korean"> 한식 </a></li>
        <li> <a href="myrecipelist.php?menu=japan"> 일식 </a></li>
        <li> <a href="myrecipelist.php?menu=baking"> 베이킹 </a></li>
    </ul>
</div>

</div>


<div id="div_con">
    <div style="width: 90%; height: auto; margin-left: 50px; border-bottom: 1px solid rgba(212,212,212,0.81);">
        <div id = "title" align="left" style="height: 30px; width : 100%; margin-bottom: 10px;" >
            <a style=" font-size: 30px; font-weight: bold; font-family: "Trebuchet MS", Dotum>  <?php echo "$row[title]";?> </a>
        </div>
        <div style="width: 100%; margin-right: 15px" align="right" > <?php $day = substr($row[regist_day],0,10);    echo "<h5>$row[name] | $day </h5>";?>
        </div>
        <br><br>
        <div style="height: auto; min-height: 500px;"> <?php echo "$row[content]"; ?>
        </div>

    </div>
        <div style="height: auto; width: 100%;">

            <table style="width: 100%; height: auto; border-collapse:collapse;">
                <?php
                $sql="select * from comment where food_no ='$food_no'";
                $comment_result = mysqli_query($connect,$sql);

                while($comment = mysqli_fetch_array($comment_result)) {
                    $comment_content = str_replace("\n","<br>",$comment[comment]);
                    $comment_content = str_replace(" ","&nbsp",$comment_content);

                    ?>
                    <script>
                        function comment_delete() {
                            if (confirm("정말 삭제하시겠습니까?")) {
                                location.href = '../comment/comment_delete.php?comment_no=<?php echo "$comment[comment_no]"?>&food_no=<?php echo "$comment[food_no]"?>&menu=<?php echo "$menu"?>&recipe=my';
                            }
                        }
                    </script>
                    <tr>
                        <td><?php echo "<font size='3'>$comment[nick]</font><font size='2'>($comment[user_id])</font>"?>  &nbsp;<?php echo "<font size='2'>$comment[comment_day]</font>"?>
                            <?php if($comment[user_id] == $id) { echo "<a  onclick='comment_delete()';> <font size='1'> 삭제 </font> </a> </td>";
                            }
                          ?>
                            <br>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(211,211,211,0.81)">
                        <td><?php echo "$comment_content"?></td>
                    </tr>

                <?php }
                ?></table> <br>
            <form action="../comment/comment_insert.php?food_no=<?php echo "$food_no"?>&menu=<?php echo "$menu"?>" method="post">
                <textarea style="width:90%;height:50px" name="ir1" id="ir1"></textarea><input type="submit" style="height: 35px; margin-bottom: 15px" value="댓글입력"> </form>
        </div>

        <div align="right">
            <input type="button" value="수정" onclick="location.href='update__content.php?food_no=<?php echo "$food_no"?>&myrecipe=myrecipe'">
            <input type="button" value="삭제" onclick="showConfirm()">
            <input type="button" value="목록" onclick="location.href='myrecipelist.php?menu=<?php echo "$menu"?>'">
            <input type='button' value='리뷰보기' onclick="location.href='../review/reviewlist.php?food_no=<?php echo "$food_no"?>&menu=<?php echo "$menu"?>'">
    </div>
    <div style="height: 5px"></div>
</div>



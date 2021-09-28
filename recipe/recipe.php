<?php
include '../main/head.php';
include '../dbconn.php';

$id =  $_SESSION['userid'];
$member_page = $_GET['page'];

$menu = $_GET['menu'];
$food_no = $_GET['food_no'];
$sql = "select * from food where food_no = '$food_no'";
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result);

$sql = "select * from member where id ='$row[user_id]'";
$result = mysqli_query($connect,$sql);
$member = mysqli_fetch_array($result);

?>



<style>
    #div_menu {
        width: 13%;
        height: 100%;
        float: left;
        text-align: left;
        position: fixed;
        margin-left: 10px;

    }

    #div_con{
        width: 70%;
        height: 98%;
        margin-left: 25%;
        float: left;
        text-align: center;

    }

    #profile {
        border: 1px solid rgba(218,218,218,0.81);
        width: 80%;
        height: 290px;
        margin-top: 15px;
        margin-left: 10px;
        background-color: white;

    }
    #profile_images {
        width: 90%;
        height: 70%;
        margin-top: 10px;
        border: 0px solid;
        border-radius: 7px;
        -moz-border-radius: 7px;
        -khtml-border-radius: 7px;
        -webkit-border-radius: 7px;
    }
    #menu {
        width: 80%;
        height: 300px;
        margin-left: 10px;
        margin-top: 20px;
    }
    #content {
        width:100%;
        height:700px;
        margin-top:250px;
    }
    #menu ul {
        list-style-type: none;
    }

    #menu ul li {
        line-height: 33px;
        text-align: right;

    }

</style>
<script language="javascript">
    function showConfirm() {
        if (confirm("정말 삭제하시겠습니까?"))
        {
            location.href='./delete.php?delete=<?php echo "$food_no"?>';
        }
    }
    function login() {
        window.alert('로그인이 필요한 서비스입니다.');
    }
</script>

<div id="content" align="center">
    <div style="width: 1250px; height: 100%;" >
        <div id = "div_menu"  >
            <div id = "profile" align="center" >
                <?php
                    echo " <img id = \"profile_images\" src='../$member[photo]'>
                        <div align=\"left\" style=\"margin-left: 10px; margin-top: 5px\">
                                    <font size=\"4\" onclick=\"location.href='../member/member_main.php?member_id=$member[id]&menu=all&page=member'\"> $member[nick] </font> <br>
                                    <font size=\"2\"> ($member[id])   </font> 
                                </div>
                                <div align=\"right\" style=\"margin-right: 15px; margin-top: 10px\">
                                ";
                                if($member[id] != $id) {
                                    if(!$id) {
                                        echo "<a onclick=\"location.href='../login/login_form.php';login()\"><font size=\"2\"> ☞ 쪽지 </font></a>
                                </div>";
                                    } else {
                                    echo "<a onclick=\"window.open('../messege/messege_form.php?member=$member[id]','a','width=680, height=715,left=100, top=150')\"><font size=\"2\"> ☞ 쪽지 </font></a>
                                </div>"; }
                                }
                                else { echo "
                                </div>";
                                }?>
            </div>
        </div>
<div id="div_con">
    <div style="width: 90%; height: auto; margin-left: 50px;" style="border-bottom: 1px solid rgba(212,212,212,0.81)" >
    <div id = "title" align="left" style="height: 30px; width : 100%; margin-bottom: 10px;" >
        <a style=" font-size: 30px; font-weight: bold; font-family: "Trebuchet MS", Dotum>  <?php echo "$row[title]";?> </a>
    </div>
        <div style="width: 100%; margin-right: 15px" align="right" > <?php $day = substr($row[regist_day],0,10);  echo "<h5>$row[name] | $day </h5>";?>
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
                <script language="javascript">
                    function comment_delete() {
                        if (confirm("정말 삭제하시겠습니까?")) {
                            location.href = '../comment/comment_delete.php?comment_no=<?php echo "$comment[comment_no]"?>&food_no=<?php echo "$comment[food_no]"?>&menu=<?php echo "$menu"?>';
                        }
                    }
                </script>

                    <tr>
                        <td><?php echo "<font size='3'>$comment[nick]</font><font size='2'>($comment[user_id])</font>"?>  &nbsp;<?php echo "<font size='2'>$comment[comment_day]</font>"?>
                            <?php if($comment[user_id] == $id) { echo " <a onclick='comment_delete()';> <font size='1'> 삭제 </font> </a></td>";
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
                <textarea style="width:90%;height:50px" name="ir1" id="ir1"></textarea> <input type="submit"style="height: 35px; margin-bottom: 15px" value="댓글입력"></form>
        </div>

        <div align="right">
            <?php
            if($member[id] == $id) {
                echo "
            <input type='button' value='수정' onclick=\"location.href='./update__content.php?food_no=$food_no'\">
            <input type='button' value='삭제' onclick=\"showConfirm()\">";
            };
            if($member_page == 'member') {
                echo "&nbsp <input type='button' value='목록' onclick=\"location.href='../member/member_main.php?member_id=$member[id]&menu=$menu'\">";
            } else {
                echo "&nbsp <input type='button' value='목록' onclick=\"location.href='./cooking_main.php?menu=$menu'\">";
            }
            if($member[id] != $id) {
                    if(!$id) {
                        echo "
                <input type='button' value='리뷰쓰기' onclick=\"location.href='../login/login_form.php';login()\">";
                    } else {
                echo "
                    <input type='button' value='리뷰쓰기' onclick=\"location.href='../review/review_register.php?food_no=$food_no'\"> ";
                    }
                }
                ?>
            <input type='button' value='리뷰보기' onclick="location.href='../review/reviewList.php?food_no=<?php echo "$food_no"?>&menu=<?php echo "$menu"?>'">
        </div>
        <div style="height: 5px"></div>
</div>
        <?php
            mysqli_close();
        ?>

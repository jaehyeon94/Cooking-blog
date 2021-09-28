<?php
include '../main/head.php';
include '../dbconn.php';

$id =  $_SESSION['userid'];

$page = $_GET['page'];
$review_no = $_GET['review_no'];
$sql = "select * from review where review_no = '$review_no'";
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result);

$sql = "select * from food where food_no ='$row[food_no]'";
$result = mysqli_query($connect,$sql);
$food = mysqli_fetch_array($result);

$sql = "select * from member where id ='$food[user_id]'";
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
                location.href='./review_delete.php?review_no=<?php echo "$review_no"?>&food_no=<?php echo "$row[food_no]"?>&menu=<?php echo "$food[type]"?>';
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
                    echo " <img id = \"profile_images\" src='../$food[photo]'>
                        <div align=\"left\" style=\"margin-left: 10px; margin-top: 5px\">
                                    <font size=\"4\"> $food[title] </font> <br>
                                    <font size=\"2\"> $member[id]</font> <font size=\"2\"> ($member[nick])</font>  
                                </div>
                                <div align=\"right\" style=\"margin-right: 15px; margin-top: 10px\">
                                <a onclick=\"location.href='../recipe/recipe.php?menu=$food[type]&food_no=$food[food_no]'\"><font size=\"2\"> ☞ 레시피 보기 </font></a>
                                </div>";?>
                </div>
            </div>
            <div id="div_con" >
                <div style="width: 90%; height: auto; margin-left: 50px;" >
                    <div id = "title" align="left" style="height: 30px; width : 100%; margin-bottom: 10px;" >
                        <a style=" font-size: 30px; font-weight: bold; font-family: "Trebuchet MS", Dotum>  <?php echo "$row[title]";?> </a>
                    </div>
                    <div style="width: 100%; margin-right: 15px" align="right" > <?php $day = substr($row[regist_day],0,10);  echo "<h5>$row[name] | $day </h5>";?>
                    </div>
                    <br><br>
                    <div style="height: auto; min-height: 500px;"> <?php echo "$row[review_content]"; ?>
                    </div>
                    <div align="right">
                        <?php
                        if($row[user_id] == $id) {
                            echo "
            <input type='button' value='수정' onclick=\"location.href='./update_review.php?review_no=$review_no&food_no=$row[food_no]&menu=$food[type]'\">
            <input type='button' value='삭제' onclick=\"showConfirm()\">";
                        };
                        ?>
                        <?php
                            $re = $_GET['re'];
                        if($re == "review") {
                            echo "<input type='button' value='목록' onclick=\"location.href='./review_main.php'\">";
                        } else {
                            echo "<input type='button' value='목록' onclick=\"location.href='./reviewlist.php?food_no=$row[food_no]&menu=$food[type]'\">";
                        }
                        ?>

                    </div>
                    <div style="height: 5px"></div>
                </div>
            </div>
            <?php
            mysqli_close();
            ?>

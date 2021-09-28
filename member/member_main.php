<?php
session_start();

include '../dbconn.php';
include '../main/head.php';

$scale = 9;
$id =  $_SESSION['userid'];
$member_id = $_GET['member_id'];
$menu = $_GET['menu'];
$member_page = $_GET['page'];

$sql = "select * from member where id ='$member_id'";
$result = mysqli_query($connect,$sql);
$member = mysqli_fetch_array($result);

if($mode=="search") {
    if (!$scale) {
        echo("
                <scriot>
                    window.alert('검색할 단어를 입력해 주세요!');
                    history.go(-1);
                    </scriot>");
        exit;
    }

    if ($menu == "all") {
        $sql = "select * from food where $find like '%$search%' and user_id = '$member_id' order by food_no desc";
    } else {
        $sql = "select * from food where $find like '%$search%' and user_id = '$member_id' and type ='$menu' order by food_no desc";
    }
}
else {
    if($menu == "all") {
        $sql = "select * from food where user_id = '$member_id' order by food_no desc";
    }
    else {
        $sql = "select * from food where user_id = '$member_id' and type = '$menu' order by food_no desc";
    }
}
$result = mysqli_query($connect,$sql);

$total_record = mysqli_num_rows($result);
if($total_record % $scale==0)
    $total_page=floor($total_record/$scale);
else
    $total_page = floor($total_record/$scale) + 1;

if(!$page)
    $page=1;

$start = ($page -1) * $scale;
$number=$total_record - $start;

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
<div id="content" align="center">
    <div style="width: 1250px; height: 100%;" >
        <div id = "div_menu"  >
            <div id = "profile" align="center" >
                <?php
                echo " <img id = \"profile_images\" src='../$member[photo]'>
                        <div align=\"left\" style=\"margin-left: 10px; margin-top: 5px\">
                                    <font size=\"4\"> $member[nick]  </font> <br>
                                    <font size=\"2\"> ($member[id])   </font> 
                                </div>
                                <div align=\"right\" style=\"margin-right: 15px; margin-top: 10px\">
                                ";
                if($member_id != $id) {
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
    <div id="div_con" >
        <div id = "title" align="left">
            <?php
            if($menu == 'all') {
                echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  전체 </a>";
            }  elseif($menu == 'simple') {
                echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  간단한 요리 </a>";
            } elseif ($menu == 'Korean') {
                echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  한식 </a>";
            } elseif ($menu == 'japan') {
                echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  일식 </a>";
            } elseif ($menu == 'baking') {
                echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  베이킹 </a>";
            }
            ?>
        </div>
        <div align="left" style="width: 1000px; height: auto;  min-height: 500px;">
            <table style="width: auto; height: auto; min-width: 500px"  >
                <?php
                $num = 1;
                for($i=$start; $i<$start+$scale && $i <$total_record; $i++) {
                    mysqli_data_seek($result,$i);
                    $row=mysqli_fetch_array($result);
                    if($num%4 == 1) {
                        echo "<tr><td style='width: 250px; height: 300px;'><div style='width: 230px; height: 300px; margin-top: 15px;' align='center' onclick=\"location.href='../recipe/recipe.php?food_no=$row[food_no]&menu=$menu&page=$member_page'\"><img src='../$row[photo]' style='width: 230px; height: 270px'>
                                   <a>$row[title]</a></div></td>";
                    } elseif ($num%4 == 2 || $num%4 == 3) {
                        echo "<td style='width: 250px; height: 300px;'><div style='width: 230px; height: 300px; margin-top: 15px;' align='center' onclick=\"location.href = '../recipe/recipe.php?food_no=$row[food_no]&menu=$menu&page=$member_page'\"><img src='../$row[photo]' style='width: 230px; height: 270px'>
                                   <a>$row[title]</a></div></td>";
                    } elseif ($num%4 == 0) {
                        echo "<td style='width: 250px; height: 300px;'><div style='width: 230px; height: 300px; margin-top: 15px;' align='center' onclick=\"location.href = '../recipe/recipe.php?food_no=$row[food_no]&menu=$menu&page=$member_page'\"><img src='../$row[photo]' style='width: 230px; height: 270px'>
                                   <a>$row[title]</a></div></td></tr>";
                    }
                    $num++;
                    if($num == 10) {
                        break;
                    }
                }
                ?>
            </table>
        </div>
        <div style="margin-left: 15%">
            <?php
            for ($i=1; $i<=$total_page; $i++) {
                if($page==$i) {
                    echo "<b> $i </b>";
                }
                else {
                    echo "<a href='member_main.php?page=$i&menu=$menu'> $i </a>";
                }
            }
            mysqli_close();
            ?>
            <form method="post" action="member_main.php?menu=<?php echo "$menu"?>&mode=search">
                <div align="center">
                    <select name="find">
                        <option value="title"> 제목 </option>
                        <option value="name"> 글쓴이 </option>
                        <option value="content"> 내용 </option>
                        <option value="user_id"> 아이디 </option>
                    </select>
                    <input type="text" name="search">
                    <input type="submit" value="검색">
                </div>
            </form>
        </div>
        <?php if($member_id == $id) {
            echo " <div align=\"right\">
            <input type=\"button\" value=\"글쓰기\" onclick=\"location.href='../recipe/index.php'\">
        </div>";
        }
        ?>
    </div>
</div>
</div>




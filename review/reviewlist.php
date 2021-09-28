<?php
include '../main/head.php';
include '../dbconn.php';

$id =  $_SESSION['userid'];
$food_no = $_GET['food_no'];
$menu = $_GET['menu'];
$sql = "select * from food where food_no = '$food_no'";
$result = mysqli_query($connect,$sql);
$food = mysqli_fetch_array($result);


$sql = "select * from review where food_no ='$food_no'";
$result = mysqli_query($connect,$sql);
$review = mysqli_fetch_array($result);

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
    #food_images {
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
                echo " <img id = \"food_images\" src='../$food[photo]'>
                        <div align=\"left\" style=\"margin-left: 10px; margin-top: 5px\">
                                    <font size=\"4\">$food[title]</font> <br>
                                    <font size=\"2\">$food[name]</font><font size=\"2\">($food[user_id])</font> 
                                </div>
                                <div align=\"right\" style=\"margin-right: 15px; margin-top: 10px\">
                                <a onclick=\"location.href='../recipe/recipe.php?food_no=$food_no&menu=$menu'\"><font size=\"2\"> 상세보기 </font></a>
                                </div>";
                ?>
            </div>
        </div>

        <div id="div_con" >
            <?php
            $scale = 10;
            $page = $_GET['page'];
            $user = $_SESSION['userid'];

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

            $review_day = substr($review[regist_day],0,10);
            ?>
            <div id = "title" align="left">
                    <a style="font-size: 30px; font-weight: bold; font-family: Trebuchet MS", Dotum>  리뷰 페이지 </a>
            </div>
            <div style="width: 100%; height: 60%; margin-top: 110px;" >
                <table style="width: 100%; border-top: 1px solid;" >
                    <tr>
                        <td style="width: 10%"> 번호 </td>
                        <td style="width: 65%" align="center"> 제목 </td>
                        <td style='width: 15%'> 작성자 </td>
                        <td style='width: 10%'> 작성 날짜 </td>
                    </tr>
                    <?php
                    for($i=$start; $i<$start+$scale && $i <$total_record; $i++) {
                        mysqli_data_seek($result,$i);

                        $review=mysqli_fetch_array($result);
                        ?>
                        <tr style="border-bottom: 1px solid black">
                            <td style="width: 10%"> <?php echo "$number"?> </td>
                            <td style="width: 65%;"><a onclick="location.href='./review.php?review_no=<?php echo "$review[review_no]"?>'"><?php echo "$review[title]" ?> </a></td>
                            <td style="width: 15%"> <?php echo "$review[user_id]" ?> </td>
                            <td style="width: 10%"> <?php echo "$review_day" ?> </td>
                        </tr>
                        <?php
                        $number--;
                    }
                    ?>
                </table>
                <div>
                    <?php
                    for ($i=1; $i<=$total_page; $i++) {
                        if($page==$i) {
                            echo "<b> $i </b>";
                        }
                        else {
                            echo "<a href='./reviewlist.php?page=$i&menu=$menu'> $i </a>";
                        }
                    }
                    mysqli_close();
                    ?>
                </div>
            </div>
            <div align="right">
                <input type="button" value="리뷰쓰기" onclick="location.href='./review_register.php?food_no=<?php echo "$food_no"?>$menu=<?php echo "$menu"?>'">
            </div>
        </div>
    </div>
</div>

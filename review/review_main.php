<?php
include '../main/head.php';
include '../dbconn.php';

$id =  $_SESSION['userid'];
$food_no = $_GET['food_no'];
$menu = $_GET['menu'];
$mode = $_GET['mode'];
$find = $_POST['find'];
$search = $_POST['search'];


if($mode=="search") {
    $sql = "select * from review where $find like '%$search%'";
    $result = mysqli_query($connect,$sql);
    $review = mysqli_fetch_array($result);

    $sql_food = "select user_id,title,photo from food where food_no = '$review[food_no]';";
    $result_food = mysqli_query($connect,$sql_food);
    $food = mysqli_fetch_array($result_food);

} else {
    $sql = "select * from review";
    $result = mysqli_query($connect,$sql);
    $review = mysqli_fetch_array($result);
    }








?>

<style>


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
    tr {
        border-bottom: 1px solid black;
    }

</style>
<div id="content" align="center">
    <div style="width: 1000px; height: auto%;" >
        <div id = "title" align="left" style="height: 30px; width : 100%; margin-bottom: 20px;" >
            <a style=" font-size: 30px; font-weight: bold; font-family: "Trebuchet MS", Dotum>  리뷰게시판 </a>
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
            ?>

            <div style="width: 100%; height: 60%; margin-top: 110px; min-height: 500px;" >
                <table style="width: 100%; border-top: 1px solid; border-collapse:collapse;">
                    <tr style="background-color: rgba(244,244,244,0.81)">
                        <td style="width: 5%" align="center"> 번호 </td>
                        <td style="width: 10%;"> &nbsp 음식 </td>
                        <td style="width: 55%" align="center"> 제목 </td>
                        <td style='width: 15%' align="center"> 작성자 </td>
                        <td style='width: 15%' align="center"> 작성 날짜 </td>
                    </tr>
                    <?php
                    for($i=$start; $i<$start+$scale && $i <$total_record; $i++) {
                        mysqli_data_seek($result,$i);
                        $review=mysqli_fetch_array($result);

                            $sql_food = "select user_id,title,photo from food where food_no = '$review[food_no]';";
                            $result_food = mysqli_query($connect,$sql_food);
                            $food = mysqli_fetch_array($result_food);

                        ?>
                        <tr style="border-bottom: 1px solid black;">
                            <td style="width: 5%" align="center"> <?php echo "$number"?> </td>
                            <td style="width: 10%"> <img src="<?php echo "../$food[photo]"?>" width="55px" height="55px"></td>
                            <td style="width: 55%;" onclick="location.href='./review.php?review_no=<?php echo "$review[review_no]"?>&re=review'"><font size="4"><?php echo "$food[title]"?></font><font size="2">(<?php echo "$food[user_id]"?>)</font><br><a><?php echo "$review[title]" ?> </a></td>
                            <td style="width: 15%" align="center"> <?php echo "$review[user_id]" ?> </td>
                            <td style="width: 15%" align="center"> <?php echo "$review[regist_day]" ?> </td>
                        </tr>
                        <?php
                        $number--;
                    }
                    ?>
                </table>
            </div>
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
                    <form method="post" action="./review_main.php?mode=search">
                        <div align="center">
                            <select name="find">
                                <option value="title"> 제목 </option>
                                <option value="user_id"> 작성자 </option>
                                <option value="review_content"> 내용 </option>
                            </select>
                            <input type="text" name="search">
                            <input type="submit" value="검색">
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

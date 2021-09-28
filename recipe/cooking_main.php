<?php
    session_start();

    include "../main/head.php";
    include "../dbconn.php";
 ?>

<style>

    #div_menu {
        width: 10%;
        height: 100%;
        float: left;
        text-align: left;
        position: fixed;
        margin-top: 3%;
        margin-right: 20%;

    }

    #div_con{
        width: 70%;
        height: 98%;
        margin-left: 15%;
        float: left;
        text-align: center;

    }

    #menu {
        width: 80%;
        height: 300px;
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
        <div id = "div_menu" >
            <div id="menu">
            <ul>
                <li><a href="./cooking_main.php?menu=all"> 전체 </a></li>
                <li><a href="./cooking_main.php?menu=simple"> 간단한 요리 </a></li>
                <li><a href="./cooking_main.php?menu=korean"> 한식 </a></li>
                <li><a href="./cooking_main.php?menu=japan"> 일식 </a></li>
                <li><a href="./cooking_main.php?menu=baking"> 베이킹 </a></li>
            </ul>
        </div>
        </div>
        <?php
        $scale = 12;
        $mode = $_GET['mode'];
        $find = $_POST['find'];
        $search = $_POST['search'];
        $page = $_GET['page'];
        $menu = $_GET['menu'];

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
                $sql = "select * from food where $find like '%$search%' order by food_no desc";
            } else {
                $sql = "select * from food where $find like '%$search%' and type ='$menu' order by food_no desc";
            }

        }
        else {
            if ($menu == "all") {
                $sql = "select * from food order by food_no desc";
            } else {
                $sql = "select * from food where type ='$menu' order by food_no desc";
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
        <div id="div_con" >
            <div id = "title" align="left">
                <?php
                if($menu == 'all') {
                    echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  전체 </a>";
                }  elseif($menu == 'simple') {
                    echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  간단한 요리 </a>";
                } elseif ($menu == 'korean') {
                    echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  한식 </a>";
                } elseif ($menu == 'japan') {
                    echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  일식 </a>";
                } elseif ($menu == 'baking') {
                    echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  베이킹 </a>";
                }
                ?>
            </div>
            <div align="left" style="width: 1000px; height: auto;  min-height: 550px;">
                <table style="width: auto; height: auto; min-width: 500px"  >
                <?php
                    $num = 1;
                for($i=$start; $i<$start+$scale && $i <$total_record; $i++) {
                    mysqli_data_seek($result,$i);
                    $row=mysqli_fetch_array($result);
                if($num%4 == 1) {
                    echo "<tr><td style='width: 250px; height: 300px;'><div style='width: 230px; height: 300px; margin-top: 15px;' align='center' onclick=\"location.href='./recipe.php?food_no=$row[food_no]&menu=$menu'\"><img src='../$row[photo]' style='width: 230px; height: 270px'>
                                   <a>$row[title]</a></div></td>";
                } elseif ($num%4 == 2 || $num%4 == 3) {
                    echo "<td style='width: 250px; height: 300px;'><div style='width: 230px; height: 300px; margin-top: 15px;' align='center' onclick=\"location . href = './recipe.php?food_no=$row[food_no]&menu=$menu'\"><img src='../$row[photo]' style='width: 230px; height: 270px'>
                                   <a>$row[title]</a></div></td>";
                } elseif ($num%4 == 0) {
                    echo "<td style='width: 250px; height: 300px;'><div style='width: 230px; height: 300px; margin-top: 15px;' align='center' onclick=\"location . href = './recipe.php?food_no=$row[food_no]&menu=$menu'\"><img src='../$row[photo]' style='width: 230px; height: 270px'>
                                   <a>$row[title]</a></div></td></tr>";
                }
                    $num++;
                        if($num == 13) {
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
                        echo "<a href='./cooking_main.php?page=$i&menu=$menu'> $i </a>";
                    }
                }
                ?>
            <form method="post" action="./cooking_main.php?menu=<?php echo "$menu"?>&mode=search">
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
        </div>
    </div>
</div>


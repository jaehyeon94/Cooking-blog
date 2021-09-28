<?php
session_start();
include "../member/myprofile.php";
include "../dbconn.php";
$menu= $_GET['menu'];
$mode = $_GET['mode'];
$find = $_POST['find'];
$search = $_POST['search'];
?>
<div id = "menu" align="center">
    <ul>
        <li> <a href="messege_main.php?menu=send"> 보낸 쪽지함 </a></li>
        <li> <a href="messege_main.php?menu=receive"> 받은 쪽지함 </a></li>

    </ul>
</div>

</div>


<div id="div_con" >
    <div id = "title" align="left">
        <?php
        if($menu == 'send') {
            echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  보낸 쪽지함 </a>";
        }  elseif($menu == 'receive') {
            echo "<a style=\"font-size: 30px; font-weight: bold; font-family: Trebuchet MS\", Dotum>  받은 쪽지함 </a>";
        }
        ?>
    </div>

    <?php
    $scale = 10;
    $page = $_GET['page'];
    $user = $_SESSION['userid'];
    if($mode=="search") {
        if (!$scale) {
            echo("
                <scriot>
                    window.alert('검색할 단어를 입력해 주세요!');
                    history.go(-1);
                    </scriot>");
            exit;
        }

        if ($menu == 'send') {
            $sql = "select * from send where $find like '%$search%'and send ='$user' order by messege_no desc";
        } elseif($menu == 'receive') {
            $sql = "select * from receive where $find like '%$search%'and receive='$user' order by messege_no desc";
        }
    }
    else {
        if($menu == 'send') {
            $sql = "select * from send where send='$user' order by messege_no desc";
        }
       elseif($menu == 'receive') {
            $sql = "select * from receive where receive='$user' order by messege_no desc";
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

    <form method="post" action="messege_main.php?menu=<?php echo "$menu"?>&mode=search">
        <div align="right" style="margin-top: 100px">
            <select name="find">
                <option value="title"> 제목 </option>
                <?php  if($menu == 'send') {
                    echo "<option value='receive'> 받는 사람 </option>";
                }     elseif($menu == 'receive') {
                    echo "<option value='send '> 보낸 사람 </option>";
                }
                    ?>
                <option value="content"> 내용 </option>
                <option value="user_id"> 아이디 </option>
            </select>
            <input type="text" name="search">
            <input type="submit" value="검색">
        </div>
    </form>
    <div style="width: 100%; height: 60%" >
        <table style="width: 100%; border-top: 1px solid;" >
            <tr>
                <td style="width: 10%"> 번호 </td>
                <td style="width: 65%" align="center"> 제목 </td>
                <?php
                    if($menu == 'send') {
                        echo "<td style='width: 15%'> 받는 사람 </td>
                                <td style='width: 10%'> 보낸 날짜 </td>";}
                   elseif($menu == 'receive') {
                        echo "<td style='width: 15%'> 보낸 사람 </td>
                                <td style='width: 10%'> 받은 날짜 </td>";
                } ?>
            </tr>
            <?php
            for($i=$start; $i<$start+$scale && $i <$total_record; $i++) {
                mysqli_data_seek($result,$i);

                $row=mysqli_fetch_array($result);
                $iten_title = str_replace("","&nbsp",$row[title]);

                    if($menu == 'send') {
                        ?>
                        <tr style="border-bottom: 1px solid black">
                            <td style="width: 10%"> <?php echo "$number"?> </td>
                            <td style="width: 65%;"><a onclick="window.open('./messege_window.php?messege_no=<?php echo "$row[messege_no]"?>&menu=<?php echo "$menu"?>','쪽지함','width=680, height=715,left=100, top=150')"><?php echo "$row[title]" ?> </a></td>
                            <td style="width: 15%"> <?php echo "$row[receive]" ?> </td>
                            <td style="width: 10%"> <?php echo "$row[regist_day]" ?> </td>
                        </tr>
                        <?php
                        $number--;
                    } elseif ($menu == 'receive') {
                        ?>
                        <tr style="border-bottom: 1px solid black">
                            <td style="width: 10%"> <?php echo "$number"?> </td>
                            <td style="width: 65%;"><a onclick="window.open('./messege_window.php?messege_no=<?php echo "$row[messege_no]"?>&menu=<?php echo "$menu"?>','쪽지함','width=680, height=715,left=100, top=150')"><?php echo "$row[title]" ?> </a></td>
                            <td style="width: 15%"> <?php echo "$row[send]" ?> </td>
                            <td style="width: 10%"> <?php echo "$row[regist_day]" ?> </td>
                        </tr>
                      <?php
                        $number--;
                    }
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
                    echo "<a href='./messege_main.php?page=$i&menu=$menu'> $i </a>";
                }
            }
            mysqli_close();
            ?>

        </div>
    </div>
</div>
</div>
</div>

<?php
include '../main/head.php';
include '../dbconn.php';

$id =  $_SESSION['userid'];
$sql = "select * from member where id = '$id'";
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result);

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

<script>
    function Open() {
        myWin = window.open("../member/load.php","new","width =300, height=5");
    }
    function Close() {
        myWin.close();
    }

</script>


<div id="content" align="center">
    <div style="width: 1250px; height: 100%;" >
        <div id = "div_menu"  >
            <div id = "profile" align="center" >
                <?php
                    if($row[photo] == "images/default.png") {
                echo " <div style=\"height: 100px; margin-top: 100px; width= 100px; background-image: url(../images/default.png)\" > <input type='button' value='이미지 등록' onclick='Open()'> </div>"; }
                    else {
                echo " <img id = \"profile_images\" src='../$row[photo]'>";
                    }
                echo "  <div align=\"left\" style=\"margin-left: 10px; margin-top: 5px\">
                                    <font size=\"4\"> $row[nick]  </font> <br>
                                    <font size=\"2\"> ($row[id])   </font> 
                                </div>
                                <div align=\"right\" style=\"margin-right: 15px; margin-top: 10px\">
                                    <a href='../member/member_modify.php'> <font size=\"2\"> ☞ 회원수정 </font></a>
                                </div>";

                mysqli_close();
                ?>
            </div>





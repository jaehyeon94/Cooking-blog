<?php
session_start();
?>
<meta  http-equiv="Content-Type" content="text/html" charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1,0">
<style>
    a {
        text-decoration:none ;
        color: #666666;
    }

    #header-wrap{
        width:100%;
        height:230px;    /*상단 메뉴 높이*/
        top:0;     /*맨 상단에 위치*/
        position:fixed;    /*위치 fixed*/
        background-color: white;
    }


    #topMenu {
        height: 30px;
        width: 100%;
        float: left;
        margin-top: 2px;
    }

    #topMenu ul { /* 메인 메뉴 안의 ul을 설정함: 상위메뉴의 ul+하위 메뉴의 ul */
        list-style-type: none;
        margin: 0px;
        padding: 0px;
    }
    #topMenu ul li { /* 메인 메뉴 안에 ul 태그 안에 있는 li 태그의 스타일 적용(상위/하위메뉴 모두) */
        color: white;
        line-height: 30px;
        vertical-align: middle;
        text-align: center;
        position: relative;
        display:inline-block;
    }
    .menuLink { /* 상위 메뉴와 하위 메뉴의 a 태그에 공통으로 설정할 스타일 */
        text-decoration:none;
        display: block;
        width: 150px;
        font-size: 12px;
        font-weight: bold;
        font-family: "Trebuchet MS", Dotum;
    }
    .submenuLink {
        text-decoration:none;
        display: block;
        font-weight: bold;
        font-size: 12px;
        font-family: "Trebuchet MS", Dotum;
        width: 112px;
    }
    .topMenuLi:hover .menuLink { /* 상위 메뉴의 li에 마우스오버 되었을 때 스타일 설정 */
        color: rgba(221,204,172,0.81);
    }


    .submenu { /* 하위 메뉴 스타일 설정 */
        position: absolute;
        height: 0px;
        overflow: hidden;
        width: 470px; /* [변경] 가로 드랍다운 메뉴의 넓이 */
        text-align: left;
        background-color: white;

    }
    .submenu li {
        display: inline-block; /* [변경] 가로로 펼쳐지도록 설정 */
    }
    .topMenuLi:hover .submenu { /* 상위 메뉴에 마우스 모버한 경우 그 안의 하위 메뉴 스타일 설정 */
        height: 32px;
        /* [변경] 높이를 32px로 설정 */
    }
    .submenuLink:hover {
        /* 하위 메뉴의 a 태그의 마우스 오버 스타일 설정 */
        color: rgba(221,204,172,0.81);
    }

    .submenuLink {
        /* 하위 메뉴의 a 태그 스타일 설정 */
        color: black;
        background-color: white;
        /* [변경] 배경색 변경 */


    }

    #title {
        width: 70%;
        height: 40px;
        margin-bottom: 15px;
        margin-top: 8px;
        padding-top: 10px;
        padding-left: 15px;
        float: left;
        text-align: left;
        border-right: 0px;
    }


</style>
<html>
    <head>
<div align="center" id="header-wrap">
    <div align="right" style="margin-bottom: 50px; margin-right: 2%; margin-top: 1%"  >
    <?php
        if (!$_SESSION['userid'] ) {
            echo (" <a href='../login/login_form.php'> <font size=\"2\"> 로그인 </font></a> ");
            }
        else {
                echo (" <a href='../login/logout.php'><font size=\"2\"> 로그아웃 </font></a>");
            }
   ?>
    </div>
    <div align="center" style="height: 110px; border-bottom: 2px solid rgba(233,233,233,0.81);">
        <a href="../main/main.php"><h1 style="color: rgba(188,155,93,0.81)">COOKING</h1></a>
    </div>

    <div id="topMenu" >
        <nav >
            <ul>
                <li class="topMenuLi"> <a class="menuLink" href="../main/main.php">Home</a> </li>
                <?php
                if (!$_SESSION['userid'] ) {
                    echo (" 
                <script>
                    function login() {
                        window.alert('로그인이 필요한 서비스입니다.'); }     
                </script>
                <li class=\"topMenuLi\"> <a class=\"menuLink\" href='../login/login_form.php' onclick='login()'>Myrecipe</a> </li>
                 <li class=\"topMenuLi\"> <a class=\"menuLink\" href='../login/login_form.php' onclick='login()'>Message </a> </li>
                ");
                }
                else {
                    echo (" <li class=\"topMenuLi\"> <a class=\"menuLink\" href=\"../recipe/myrecipelist.php?menu=all\">Myrecipe</a> </li>
                            <li class=\"topMenuLi\"> <a class=\"menuLink\" href=\"../messege/messege_main.php?menu=send\">Message </a> </li>");
                }
                ?>
                <li class="topMenuLi"> <a class="menuLink" href="../recipe/cooking_main.php?menu=all">Cooking</a>
                    <ul class="submenu">
                        <li><a href="../recipe/cooking_main.php?menu=simple" class="submenuLink ">간단한 요리</a></li>
                        <li><a href="../recipe/cooking_main.php?menu=korean" class="submenuLink ">한 식</a></li>
                        <li><a href="../recipe/cooking_main.php?menu=japan" class="submenuLink ">일 식</a></li>
                        <li><a href="../recipe./cooking_main.php?menu=baking" class="submenuLink ">베이킹</a></li>
                    </ul>
                </li>
                <li class="topMenuLi"> <a class="menuLink" href="../review/review_main.php">Review </a> </li>
            </ul>
            <br>
        </nav>
    </div>
</div>
    </head>

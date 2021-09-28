<html>
<head>
    <?php include '../main/head.php'; ?>
</head>
<style>
    #content {
        width:100%;
        height:500px;
        margin-top:300px;
    }

    #id_pw_title {
        width: 55px;
        height: 100%;
        float: left;
        text-align: left;
    }
    #id_pw_input{
        width: 180px;
        height: 98%;
        float: left;
        text-align: center;
        margin-top: 20px;
        margin-right: 10px;
    }
    #login_button {
        width: 90px;
        height: 98%;
        float: left;
        text-align: right;
        margin-top: 17px;
    }

    #login_Image {
        float: left;
        width: 200px;
        margin-left: 50px;
        margin-right: 70px;
        text-align: left;
    }
    #login_form {
        width: 100%;
        height: 100px;
        margin-bottom: 30px;
        margin-left: 15px;

    }
    #login {
        float: left;
        width: 380px;
        height: 120px;
        text-align: center;
        border-bottom: 1px solid;
    }

    #membership {
        width:100%;
        text-align: left;
        margin-left: 15px;
    }

</style>
<body>
<div id="content" align="center">
    <div style="width: 700px; height: 200px;">
        <div align="left">
    <h2> 로그인 </h2>
        </div>
        <div align="left" style="margin-top: 40px">
    <h3> 회원님의 아이디와 비민번호를 입력해 주세요.</h3>
        </div>
    </div>
    <div style="width: 700px; height: 200px;">
        <div id="login_Image">
            <img id = "profile_images" src="../images/cyber.png" style="width: 200px;height: 200px">
        </div>
        <form method="post" action="login.php">
        <div id="login">
            <div id="login_form">
                <div id="id_pw_title">
                    <h5> 아이디 </h5>
                    <h5> 비밀번호 </h5>
                </div>
                <div id="id_pw_input">
                    <input type="text" name="id"><br><br><input type="password" name="pass">
                </div>
                <div id="login_button">
                    <input type="submit" value="로그인" style="height: 70px; width: 100px">
                </div>
            </div>
        </form>
            <div id="membership"> <br>
                <font> ▷ 아직 회원이 아니십니까 ? </font> &nbsp;
                <input type="button" value="회원가입" onclick="location.href='../member/member_form.php'">
            </div>
        </div>
    </div>
</div>
</body>
</html>
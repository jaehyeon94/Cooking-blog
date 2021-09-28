<html>
<head>
    <?php include '../main/head.php'; ?>
<meta charset="EUC-KR">
<style>
    #content {
        width:100%;
        height:500px;
        margin-top:300px;
    }


</style>
    <script type ="text/javascript">

        function check_id() {
        window.open("check_id.php?id="+document.member_form.id.value,"IDcheck",
        "left=200,top=200,width=200,height=60,scrollbars=no," +
            "resizable=yes");
    }

    function check_input() {

        if(!document.getElementById('id').value) {
            alert("아이디를 입력하세요");
            return false;
        }

        else if(!document.getElementById('password').value) {
            alert("비밀번호를 입력하세요");
            return false;

        }

        else if(!document.getElementById('password1').value) {
            alert("비밀번호 확인을 입력하세요");
            return false;

        }

        else if(!document.getElementById('Name').value) {
            alert("닉네임 확인을 입력하세요");
            return false;
        }

        else if(document.getElementById('password').value !=
        document.getElementById('password1').value){
            alert("비밀번호가 일치하지 않습니다.")

            return false;
        }
    }

</script>
</head>
<body>

<div id="content" align="center">
    <div style="width: 700px; height: 200px;">
        <div align="left">
            <h2> 회원 가입  </h2>
        </div>
        <div align="center" style="margin-top: 40px;" >
            <form method="post" action="./insert.php">

                <p><label>아이디 : <input type="text" name="id" id="id" placeholder="아이디 입력" required ></label></p>
                <p><label>비밀번호 : <input type="password" name="pass" id="password" placeholder="비밀번호입력" required ></label></p>
                <p><label>비밀번호 확인 : <input type="password" name="pass1" id="password1" placeholder="비밀번호입력" required></label></p>
                <p><label>닉네임 : <input type="text" name="nick" id="Name" placeholder="이름 입력" required></label></p>
                <p><label>E-mail :<input type="email" name="mail" placeholder="이메일 입력" required ></label></p>

                <div align="right">
                    <input type="submit" value="가입" onclick="return check_input()">
                    <input type="reset" value="취소">
        </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>
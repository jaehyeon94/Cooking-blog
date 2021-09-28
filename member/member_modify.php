<?php
    session_start();
    include '../main/head.php';
    include '../dbconn.php';

    $id = $_SESSION["userid"];
    $sql="select * from member where id='$id'";
    $result= mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($result);

    ?>

    <html>
    <head>
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

            if(document.getElementById('password').value !=
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
                <h2> 회원 수정  </h2>
            </div>
            <div align="center" style="margin-top: 40px;" >
                <form enctype="multipart/form-data" method="post"  action="./update.php">

                <p><label>아이디 : <?php echo "$id" ?></label></p>
                <p><label>닉네임 : <?php echo "$row[nick]" ?></label></p>
                <p><label>비밀번호 : <input type="password" name="pass" id="password" placeholder="비밀번호입력" ></label></p>
                <p><label>비밀번호 확인 : <input type="password" name="pass1" id="password1" placeholder="비밀번호입력" ></label></p>
                <p><label>E-mail : <?php echo "$row[mail]" ?></label></p>
                <p><label>프로필 사진 :  <input type="file" name="screen"></div></label></p>

                <div align="right">
                    <input type="submit" value="수정" onclick="return check_input()">
                    <input type="reset" value="취소">
                </div>
            </form>

        </div>
    </div>
</div>
</body>

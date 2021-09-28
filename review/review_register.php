<!doctype html>
<?php
$food_no = $_GET['food_no'];
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>리뷰 작성하기</title>
    <?php
    include "../main/head.php"; ?>
    <script type="text/javascript" src="../nse_files/js/HuskyEZCreator.js" charset="utf-8"></script>
    <style>
        .nse_content{width:660px;height:500px}
        #content {
            width:100%;
            height:500px;
            margin-top:280px;
        }
    </style>
</head>
<body>
<div id="content" align="center">
    <div style="width: 700px; height: 200px;">
        <div align="left">
            <h2> 리뷰 작성하기  </h2>
        </div>
        <div align="center" style="margin-top: 40px;" >
            <form name="nse" action="../review/review_inset.php?food_no=<?php echo "$food_no"?>" method="post" enctype="multipart/form-data">
                <div align="lrft" style="padding-right: 15px;margin-bottom: 10px">
                    제목 : <input type="text" name = "title" style="width: 88%;" ">
                </div>
                <textarea name="ir1" id="ir1" class="nse_content" ></textarea>
                <script type="text/javascript">
                    var oEditors = [];
                    nhn.husky.EZCreator.createInIFrame({
                        oAppRef: oEditors,
                        elPlaceHolder: "ir1",
                        sSkinURI: "../nse_files/SmartEditor2Skin.html",
                        fCreator: "createSEditor2"
                    });
                    function submitContents(elClickedObj) {
                        // 에디터의 내용이 textarea에 적용됩니다.
                        oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
                        // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

                        try {
                            elClickedObj.form.submit();
                        } catch(e) {}
                    }
                </script>
                <div align="right" style="margin-right: 10px ">
                    <input type="submit" value="전송" onclick="submitContents(this)" style="width: 100px" />
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
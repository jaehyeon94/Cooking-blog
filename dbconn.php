<?php
// MySQL 데이터베이스 연결
$connect = mysqli_connect("localhost", "root", "too13258", "mysql");

// 연결 오류 발생 시 스크립트 종료
if (mysqli_connect_errno()) {
    die('Connect Error: '.mysqli_connect_error());
    }

?>

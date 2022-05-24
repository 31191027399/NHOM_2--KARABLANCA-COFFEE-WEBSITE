<?php
require_once "config.php";
function taoketnoi(&$link)
{
$link=mysqli_connect(HOST,USER,PASSWORD,DB);
if (mysqli_connect_errno()){
    echo "Lỗi kết nối đến máy chủ".mysqli_connect_error();
    exit();
}
}
function giaiPhongBoNho($link,$result)
{
try {
    mysqli_close($link);
    mysqli_free_result($result);
}
catch(TypeError $e){}
}
?>
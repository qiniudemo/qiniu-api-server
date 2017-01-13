<?php
//本例主要演示一个简单的无key文件上传，这个时候七牛会给这个文件一个默认的
//根据文件内容计算出来的hash作为名字

header("Content-Type: application/json; charset=utf-8");
require_once("../../qiniu/rs.php");
require_once("../../config.php");

Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);

$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->DeleteAfterDays = $Delete_After_Days;
$token = $putPolicy->Token(null);
$respData = array(
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;

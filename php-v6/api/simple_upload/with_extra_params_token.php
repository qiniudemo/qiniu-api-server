<?php
header("Content-Type: application/json; charset=utf-8");
require_once("../../qiniu/rs.php");
require_once("../../config.php");

Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->DeleteAfterDays = $Delete_After_Days;
$returnBody = array(
    "fsize" => "$(x:size)",
    "time" => "$(x:time)",
    "key" => "$(key)",
    "hash" => "$(hash)"
);
$putPolicy->ReturnBody = json_encode($returnBody);
$token = $putPolicy->Token(null);

$respData = array(
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;

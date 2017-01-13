<?php
header("Content-Type: application/json; charset=utf-8");
require_once("../../qiniu/rs.php");
require_once("../../config.php");

Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->DeleteAfterDays = $Delete_After_Days;
//json format
$returnBody = array(
    "key" => "$(key)",
    "hash" => "$(hash)",
    "bucket" => "$(bucket)",
    "exParam1" => "$(x:exParam1)",
    "exParam2" => "$(x:exParam2)"
);
$returnBody = json_encode($returnBody);
$putPolicy->ReturnBody = $returnBody;

$token = $putPolicy->Token(null);
$respBody = array("uptoken" => $token);
$respBody = json_encode($respBody);
echo $respBody;
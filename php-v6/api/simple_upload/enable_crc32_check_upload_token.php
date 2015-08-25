<?php
header("Content-Type: application/json; charset=utf-8");
require_once("../../qiniu/rs.php");
require_once("../../config.php");

Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);

$token = $putPolicy->Token(null);
$respData = array(
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;

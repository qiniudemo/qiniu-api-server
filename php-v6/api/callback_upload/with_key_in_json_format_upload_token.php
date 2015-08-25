<?php
header("Content-Type: application/json; charset=utf-8");
require_once("../../qiniu/rs.php");
require_once("../../config.php");

Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->CallbackUrl = $APP_CALLBACK_ROOT . "/service/callback_upload_service_auth_bodySha1.php?bodySha1=$(bodySha1)";
$callbackBody = array(
    "fname" => "$(fname)",
    "etag" => "$(etag)",
    "key" => "$(key)",
    "exParam1" => "$(x:exParam1)",
    "exParam2" => "$(x:exParam2)",
    "exParam3" => "$(x:exParam3)"
);
$callbackBody = json_encode($callbackBody);


$putPolicy->CallbackBodyType = "application/json";
$putPolicy->CallbackBody = $callbackBody;
$token = $putPolicy->Token(null);
$respData = array(
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;
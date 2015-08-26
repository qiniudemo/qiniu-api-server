<?php
header("Content-Type: application/json; charset=utf-8");
require_once("../../qiniu/rs.php");
require_once("../../config.php");

Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);

//use a random key for saveKey
$putPolicy->SaveKey = "qiniu_cloud_storage_" . time();
$putPolicy->MimeLimit="image/*";
$token = $putPolicy->Token(null);
$respData = array(
    "domain" => $Qiniu_Public_Bucket_Domain,
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;
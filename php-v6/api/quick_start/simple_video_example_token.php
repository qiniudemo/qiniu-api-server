<?php
header("Content-Type: application/json; charset=utf-8");
require_once("../../qiniu/rs.php");
require_once("../../config.php");
require_once("../../qiniu/utils.php");

Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$putPolicy->DeleteAfterDays = $Delete_After_Days;
//生成一个文件名称
$saveKey = "qiniu_cloud_storage_" . time();
$putPolicy->SaveKey = "qiniu_cloud_storage_" . time();

//转个码，得到一个mp4和m3u8
$mp4Fop = "avthumb/mp4/vb/256k/s/640x360|saveas/" . Qiniu_Encode($Qiniu_Public_Bucket . ":" . $saveKey . ".mp4");
$m3u8Fop = "avthumb/m3u8/vb/256k/s/640x360|saveas/" . Qiniu_Encode($Qiniu_Public_Bucket . ":" . $saveKey . ".m3u8");

$putPolicy->PersistentOps = $mp4Fop . ";" . $m3u8Fop;
$putPolicy->PersistentPipeline = $MPS_Pipeline;

$putPolicy->MimeLimit = "video/*";
$token = $putPolicy->Token(null);
$respData = array(
    "domain" => $Qiniu_Public_Bucket_Domain,
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;
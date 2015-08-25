<?php
header("Content-Type:application/json");
require_once("../../lib/qiniu/rs.php");
require_once("../../lib/qiniu/utils.php");
require_once("../../qiniu_config.php");
Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
$putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
$saveBucket=$Qiniu_Public_Bucket;
$saveKey="test_2.mp4";
//转码指令
$putPolicy->PersistentOps="avthumb/mp4|saveas/"+Qiniu_Encode($saveBucket+":"+$saveKey);
//转码队列
$putPolicy->PersistentPipeline="jemy";
//转码结果通知地址
$putPolicy->PersistentNotifyUrl="http://www.abc.com/fake/notifyURL";
$token = $putPolicy->Token(null);
$respData = array(
    "uptoken" => $token
);
$respBody = json_encode($respData);
echo $respBody;

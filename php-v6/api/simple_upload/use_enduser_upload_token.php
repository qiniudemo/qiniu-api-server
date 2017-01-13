<?php
header("Content-Type: application/json; charset=utf-8");
require_once("../../qiniu/rs.php");
require_once("../../config.php");

if (isset($_GET["endUser"]) && !empty($_GET["endUser"])) {
    $endUser = $_GET["endUser"];
    Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
    $putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
    $putPolicy->DeleteAfterDays = $Delete_After_Days;
    $returnBody = array("hash" => "$(hash)", "key" => "$(key)", "endUser" => "$(endUser)");
    $putPolicy->EndUser = $endUser;
    $putPolicy->ReturnBody = json_encode($returnBody);
    $token = $putPolicy->Token(null);
    $respData = array(
        "uptoken" => $token
    );
} else {
    $respData = array("error" => "no endUser specified");
}
echo json_encode($respData);
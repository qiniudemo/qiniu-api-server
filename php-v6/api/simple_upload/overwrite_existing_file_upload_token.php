<?php
header("Content-Type: application/json; charset=utf-8");
require_once("../../qiniu/rs.php");
require_once("../../config.php");

if (isset($_POST["key"]) && !empty($_POST["key"])) {
    $key = $_POST["key"];
    Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
    $putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
    $putPolicy->Scope = $Qiniu_Public_Bucket . ":" . $key;
    //very important to enable overwrite
    $putPolicy->InsertOnly = 0;
    $token = $putPolicy->Token(null);
    $respBody = array("uptoken" => $token);
} else {
    $respBody = array("error" => "no key specified");
}
echo json_encode($respBody);
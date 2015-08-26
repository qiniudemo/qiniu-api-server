<?php
header("Content-Type: application/json; charset=utf-8");

require_once("../qiniu/rs.php");
require_once("../config.php");
require_once("../qiniu/pfop.php");
require_once("../qiniu/auth_digest.php");

if (isset($_GET["persistentId"]) && $_GET["persistentId"] != "") {
    $persistentId = $_GET["persistentId"];
    $mac = new Qiniu_Mac($Qiniu_AccessKey, $Qiniu_SecretKey);
    $client = new Qiniu_MacHttpClient($mac);
    $pfopResultArray = Qiniu_PfopStatus($client, $persistentId);

    $pfopResult = $pfopResultArray[0];
    $pfopError=$pfopResultArray[1];

    if (isset($pfopResult)) {
        $code = $pfopResult["code"];
        if ($code == 0 || $code == 3 || $code == 4) {
            if (isset($pfopResult["items"])) {
                $items = $pfopResult["items"];
                $keys = array();
                foreach ($items as $item) {
                    if(isset($item["key"])) {
                        $key = $item["key"];
                        array_push($keys, $key);
                    }
                }
                $result = array(
                    "keys" => $keys,
                );
            } else {
                $result = array("error" => "no result error");
            }
        } else {
            $result = array("error" => "still under processing");
        }
    } else {
        $result = array("error" => $pfopError->Err);
    }
} else {
    $result = array("error" => "no persistentId specified");
}
echo json_encode($result);
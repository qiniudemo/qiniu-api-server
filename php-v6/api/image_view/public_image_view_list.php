<?php
header("Content-Type: application/json; charset=utf-8");
require_once("../../config.php");
$imagesRaw = array(
    "309629/1440088270699p19t5v1vem1sto1qn71jd91qv5p4132.jpg",
    "309671/1440123547209p19t70oruptpj52p1bult0m1kel1j.jpg",
    "303831/1438778844387p19ruudp2k1dht1vfc6vo6jc1qgp2.jpg",
    "1440326584/91CDC108-2469-41D1-BE97-72EF8B6EA7BA.jpg",
    "1439712268/1A6D47BE-000F-4512-99DB-7B08E3A821D2.jpg",
    "310267/1440325089759p19td10eied681vk81mo1mn64i9u.jpg",
    "292923/1433246469763p19mq23q7n10gs1lr91bqmn5579335.jpg",
    "1411671023/C1C16AE8-6162-40F1-AD8F-C73F36814415.jpg",
    "303207/1438003494628p19r7qvn0o1re81scddcj1hidb434.jpg",
    "100086/1392801464140p18h4m6ho498ugtd1vml1k72i6o1r.jpg",
    "305459/1438714619526p19rt13aneal9bqr1jqh17rh17iht.jpg",
    "309425/1440077896004p19t5l49ju1563f2q1lqrm5t1u7b2v.jpg",
    "1439648884/C81D1453-7C53-41B8-ABB5-D61ED05596A7.jpg",
    "304330/1440023905657p19t41np17t47fhp1hto1am6j051b.jpg",
);

$deviceWidth = "480";
if (isset($_GET["device_width"]) && $_GET["device_width"] != 0) {
    $deviceWidth = $_GET["device_width"];
}

$imagesToView = array();

foreach ($imagesRaw as $key) {
    array_push($imagesToView, $ImageViewBucketDomain . "/" . $key . "?imageView2/0/w/" . $deviceWidth);
}

$respData=array("images"=>$imagesToView);
echo json_encode($respData);
<?php
header("Content-Type: application/json; charset=utf-8");
$playlist = array(
    array(
        "name" => "七牛视频名片 (mp4)",
        "ads_url" => "",
        "video_url" => "http://7rf353.com1.z0.glb.clouddn.com/qiniu_640x360.mp4",),
    array(
        "name" => "七牛视频名片 (m3u8)",
        "ads_url" => "",
        "video_url" => "http://7rf353.com1.z0.glb.clouddn.com/qiniu_640x360.m3u8"),
    array(
        "name" => "七牛视频名片 (mp4) - 有广告",
        "ads_url" => "http://7rf353.com1.z0.glb.clouddn.com/qads.mp4",
        "video_url" => "http://7rf353.com1.z0.glb.clouddn.com/qiniu_640x360.mp4",),
    array(
        "name" => "七牛视频名片 (m3u8) - 有广告",
        "ads_url" => "http://7rf353.com1.z0.glb.clouddn.com/qads.m3u8",
        "video_url" => "http://7rf353.com1.z0.glb.clouddn.com/qiniu_640x360.m3u8"),
);
$respData = array(
    "playlist" => $playlist
);
echo json_encode($respData);
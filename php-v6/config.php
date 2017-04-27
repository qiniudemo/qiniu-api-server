<?php
//七牛的AK，SK，从 https://portal.qiniu.com/user/key 获取
$Qiniu_AccessKey = "";
$Qiniu_SecretKey = "";

//公开空间
$Qiniu_Public_Bucket = "if-pbl";
//公开空间对应域名，测试阶段可以使用七牛给出的默认域名，生产阶段请使用自定义域名
$Qiniu_Public_Bucket_Domain = "http://7pn64c.com1.z0.glb.clouddn.com";

//私有空间
$Qiniu_Private_Bucket = "if-pri";
//私有空间对应域名，测试阶段可以使用七牛给出的默认域名，生产阶段请使用自定义域名
$Qiniu_Private_Bucket_Domain = "http://7qnctm.com1.z0.glb.clouddn.com";

$APP_CALLBACK_ROOT="http://192.168.210.162/~jemy/qiniu-api-server/php-v6";

//图片显示域名
$ImageViewBucketDomain="http://7u2fo5.com1.z0.glb.clouddn.com";

//音视频转码队列，可以到后台 https://portal.qiniu.com/dora/create-mps 设置
$MPS_Pipeline="jemy";

$Delete_After_Days=1;

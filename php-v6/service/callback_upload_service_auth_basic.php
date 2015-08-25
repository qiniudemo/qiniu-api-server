<?php
header("Content-Type: application/json; charset=utf-8");
require("../../qiniu_config.php");
require ("../../lib/qiniu/auth_digest.php");
//the client will send fname,etag,key and three extra parameters here
//in the format of a url query string or json data
$allHeaders= getallheaders();
$reqPath=$_SERVER["REQUEST_URI"];
$reqContentType =$allHeaders["Content-Type"];
$reqAuth=$allHeaders["Authorization"];
$signToken=explode('QBox ', $reqAuth)[1];
$respBody=@file_get_contents('php://input');
$mac=new Qiniu_Mac($Qiniu_AccessKey,$Qiniu_SecretKey);
if($reqContentType=="application/x-www-form-urlencoded"){
	$localSignedToken=$mac->Sign($reqPath."\n".$respBody);
}elseif($reqContentType=="application/json"){
	$localSignedToken=$mac->Sign($reqPath."\n");
}

if ($signToken!=$localSignedToken)
{
	$error=array(
		"error"=>"Invalid callback token"
	);
	echo json_encode($error);
}
//append this timestamp to fields' value
$time=time();
if ($reqContentType=="application/x-www-form-urlencoded")
{
	//parse url query string
	$fname=$_POST["fname"];
	$etag=$_POST["etag"];
	$key=$_POST["key"];
	$exParam1=$_POST["exParam1"];
	$exParam2=$_POST["exParam2"];
	$exParam3=$_POST["exParam3"];	
	$respArray=array(
		"fname"=>$fname."-".$time,
		"etag"=>$etag."-".$time,
		"key"=>$key."-".$time,
		"exParam1"=>$exParam1."-".$time,
		"exParam2"=>$exParam2."-".$time,
		"exParam3"=>$exParam3."-".$time,
	);
	$respBody=json_encode($respArray);
	echo $respBody;
}
elseif($reqContentType=="application/json")
{
	//parse json data
	//$reqBody=http_get_request_body();
	$reqBody=@file_get_contents('php://input');
	$jsonData=json_decode($reqBody,TRUE);
	$fname=$jsonData["fname"];
	$etag=$jsonData["etag"];
	$key=$jsonData["key"];
	$exParam1=$jsonData["exParam1"];
	$exParam2=$jsonData["exParam2"];
	$exParam3=$jsonData["exParam3"];
	$respArray=array(
		"fname"=>$fname."-".$time,
		"etag"=>$etag."-".$time,
		"key"=>$key."-".$time,
		"exParam1"=>$exParam1."-".$time,
		"exParam2"=>$exParam2."-".$time,
		"exParam3"=>$exParam3."-".$time,
	);
	$respBody=json_encode($respArray);
	echo $respBody;
}
?>
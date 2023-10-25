<?php
/**
 * Created by PhpStorm.
 * User: huidaoli
 * Date: 2023/10/23
 * Time: 2:04 PM
 */

require_once __DIR__ . '/../autoload.php';

use Xhkj\Edu\EduClient;

$appKey = ""; 
$appSecret = "";

try {
	$eduClient = new EduClient($appKey,$appSecret);
} catch (OssException $e) {
	printf(__FUNCTION__ . "creating eduClient instance: FAILED\n");
	printf($e->getMessage() . "\n");
	return null;
}

//2、刷新access_token接口
/*$param = [
];
$response = json_decode($eduClient->getApiResponse("post","/ssologin/refreshtoken",$param));*/

//3、获取组织下部门列表
/*$param = [
	'team_id'=>1,
	'cursor'=>0
];
$response = json_decode($eduClient->getApiResponse("post","/api/opendept/teamdeptlist",$param));*/

//4、获取组织下用户列表
/*$param = [
	'team_id'=>1,
	'cursor'=>0
];
$response = json_decode($eduClient->getApiResponse("post","/api/openuser/teamuserlist",$param));*/

var_dump($response);
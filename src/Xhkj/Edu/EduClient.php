<?php
/**
 * Created by PhpStorm.
 * User: huidaoli
 * Date: 2023/10/23
 * Time: 2:04 PM
 */

namespace Xhkj\Edu;

use Xhkj\Edu\Core\ClientException;
use Xhkj\Edu\Core\Base;
use Xhkj\Edu\Http\RequestClint;

class EduClient extends Base
{
	public $params;

	protected $getBody = [
		'/ssologin/gettoken','/api/base/userinfo'
	];
	
	/**
	 * 构造函数
	 *
	 * 构造函数有几种情况：
	 * 一般的时候初始化使用 $eduClient = new EduClient($appKey, $appSecret)
	 * 初始化使用 $eduClient = new EduClient($appKey, $appSecret)
	 *
	 * @param string $appKey 从Open平台获得的appKey
	 * @param string $appSecret 从Open平台获得的appSecret
	 */
	public function __construct($appKey, $appSecret)
	{
		$appKey = trim($appKey);
		$appSecret = trim($appSecret);

		if (empty($appKey)) {
			throw new ClientException("app key id is empty");
		}
		if (empty($appSecret)) {
			throw new ClientException("app secret is empty");
		}
		parent::__construct($appSecret,$appKey);

		self::checkEnv();
		$this->paramMap['access_token'] = json_decode($this->getApiResponse("post","/ssologin/gettoken",['AppKey'=>$appKey,'AppSecret'=>$appSecret]))->data->access_token;

	}

	public function getApiResponse($method,$action,$params=[]){

		if(in_array($action,$this->getBody) && strtolower($method)=="post"){
			$method = "gettoken";
		}

		$params['access_token'] = $this->paramMap['access_token'];
		$this->params = $params;
		switch (strtolower($method)){
			case "get":
				$this->addBody(json_encode($this->params));
				break;
			case "post":
				$this->addBody(json_encode($this->params));
				break;
			case "gettoken":
				$this->addBody(json_encode($this->params));
				break;
			default:
				break;
		}
		$response = RequestClint::$method($action, $this);
		//清空请求参数
		$this->removeAllParam();
		return $response;
	}


	/**
	 * 用来检查sdk的扩展是否打开
	 *
	 * @throws OssException
	 */
	public static function checkEnv()
	{
		if (function_exists('get_loaded_extensions')) {
			//检测curl扩展
			$enabled_extension = array("curl");
			$extensions = get_loaded_extensions();
			if ($extensions) {
				foreach ($enabled_extension as $item) {
					if (!in_array($item, $extensions)) {
						throw new ClientException("Extension {" . $item . "} is not installed or not enabled, please check your php env.");
					}
				}
			} else {
				throw new ClientException("function get_loaded_extensions not found.");
			}
		} else {
			throw new ClientException('Function get_loaded_extensions has been disabled, please check php config.');
		}
	}
}
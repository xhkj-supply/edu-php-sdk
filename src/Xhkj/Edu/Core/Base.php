<?php
/**
 * Created by PhpStorm.
 * User: huidaoli
 * Date: 2023/10/23
 * Time: 2:04 PM
 */

namespace Xhkj\Edu\Core;

class Base
{
	public $app_secret  = '';

	public $app_key = '';

	public $paramMap = array();

	public $body = '';

	public $serverRoot = 'http://ju.wzzd.cn';


	public function __construct($app_secret, $app_key)
	{

		if(!empty($serverRoot)){
			$this->serverRoot = $serverRoot;
		}

		if(!empty($app_secret)){
			$this->app_secret = $app_secret;
		}
		if(!empty($app_key)){
			$this->app_key = $app_key;
		}

		if(!empty($app_key)){
			$this->paramMap['client_id'] = $app_key;
		}

		$this->paramMap['grant_type'] = 'client';
		$this->paramMap['redirect_uri'] = 'http://127.0.0.1/base/platform/eduyun?appname=appbase';
		$this->paramMap['access_token'] = '';

	}

	//设置body
	public function addBody($body)
	{
		$this->body = $body;
	}

	//单个添加参数
	public function addParam($key,$values)
	{
		$addParam = array($key=>$values);
		$this->paramMap = array_merge($this->paramMap,$addParam);
	}

	//批量添加参数
	public function batchAddParam($param)
	{
		$this->paramMap = array_merge($this->paramMap,$param);
	}

	//移除参数
	public function removeParam($key)
	{
		foreach ($this->paramMap as $k => $v){
			if($key == $k){
				unset($this->paramMap[$k]);
			}
		}
	}

	//移除全部参数
	public function removeAllParam()
	{
		foreach ($this->paramMap as $k => $v){
			if($k!='access_token'){
				unset($this->paramMap[$k]);
			}
		}
	}

	//获取参数
	public function getParam($key)
	{
		return $this->paramMap[$key];
	}

	//获取全部参数
	public function getAllParam()
	{
		return $this->paramMap;
	}

	//获取服务器Root
	public function getServerRoot()
	{
		return $this->serverRoot;
	}

	//获取AppKey
	public function getAppKey()
	{
		return  $this->app_key;
	}

	//获取AppSecret
	public function getAppSecret()
	{
		return $this->app_secret;
	}

}
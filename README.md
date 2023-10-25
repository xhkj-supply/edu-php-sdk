
## xhkj-supply-edu-php-sdk

xhkj-supply-edu-php-sdk是序航科技官方SDK的Composer封装，支持php项目的云平台应用API对接。
## 安装

* 通过composer，这是推荐的方式，可以使用composer.json 声明依赖，或者运行下面的命令。
```bash
$ composer require xhkj-supply/edu-php-sdk
```
* 直接下载安装，SDK 没有依赖其他第三方库，但需要参照 composer的autoloader，增加一个自己的autoloader程序。

## 运行环境

    php: >=7.0

## 使用方法

```php    

	/**
	 * Created by PhpStorm.
	 * User: huidaoli
	 * Date: 2023/10/23
	 * Time: 2:04 PM
	 */

	use Xhkj\Edu\EduClient;

	$appKey = "your appkey";
	$appSecret = "your appSecret";

	try {
		$eduClient = new EduClient($appKey,$appSecret);
	} catch (OssException $e) {
		printf(__FUNCTION__ . "creating eduClient instance: FAILED\n");
		printf($e->getMessage() . "\n");
		return null;
	}

	$param = [
		
	];
	$response = json_decode($eduClient->getApiResponse("post","/ssologin/refreshtoken",$param));

```    

## 云应用平台

官网网址 http://ju.wzzd.cn  

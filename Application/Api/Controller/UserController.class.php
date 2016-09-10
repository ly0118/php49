<?php
namespace Api\Controller;
use Think\Controller;
class UserController extends Controller {
    /*public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }*/

	public function register(){
		if(IS_POST){
			//接收输入的手机验证码
			$checkcode = $_POST['checkcode'];
			session_start();
			$code = $_SESSION['code'];
			if($code==$checkcode){
				echo 'ok';
			}else{
				echo 'no';
			}
		}else{
			$this->display();
		}
	}

	function sendTemplateSMS($to,$datas,$tempId,$accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion)
	{
		// 初始化REST SDK
		//global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
		$rest = new \REST($serverIP,$serverPort,$softVersion);
		$rest->setAccount($accountSid,$accountToken);
		$rest->setAppId($appId);
		//dump($rest);die;
		// 发送模板短信
		// echo "Sending TemplateSMS to $to <br/>";
		$result = $rest->sendTemplateSMS($to,$datas,$tempId);
		//dump($result);die;
		if($result == NULL ) {
			return false;
		}
		if($result->statusCode!=0) {
			return false;
			//TODO 添加错误处理逻辑
		}else{
			return true;
			//TODO 添加成功处理逻辑
		}
	}
	public function send(){

		$code = rand(100000,999999);
		$_SESSION['code']=$code;
		//include_once("./CCPRestSmsSDK.php");
		import("Vendor.sms.REST");
			//主帐号,对应开官网发者主账号下的 ACCOUNT SID
		$accountSid= '8aaf070856d4826c0156d6100a05036a';
			//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
		$accountToken= '431b387031944dd68b1ca3407d6b3e26';
			//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
			//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
		$appId='8aaf070856d4826c0156d6100aa90371';
			//请求地址
			//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
			//生产环境（用户应用上线使用）：app.cloopen.com
		$serverIP='sandboxapp.cloopen.com';
			//请求端口，生产环境和沙盒环境一致
		$serverPort='8883';
			//REST版本号，在官网文档REST介绍中获得。
		$softVersion='2013-12-26';


		//获取传递手机号码
		$telphone = $_GET['telphone'];
		//dump($telphone);die;
		$res = $this->sendTemplateSMS($telphone,array($code,1),"1",$accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion);//手机号码，替换内容数组，模板ID
		//var_dump($res);die;
		if($res){
			echo 1;
		}else{
			echo 0;
		}

	}
}

<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
   /* public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }*/

	//创建json对象
	public function createJson(){
		$presonArray = array(
			'name' => 'tom',
			'age'  => 21,
			'job'  => 'php',
		);
		$presonJson = json_encode($presonArray);
		dump($presonJson);
		echo "<hr />";
		echo $presonJson;
	}
	//读取json
	public function readJson(){
		$presonJson = '{"name":"tom","age":21,"job":"php"}';
		$presonArray = json_decode($presonJson,true);
		$presonObj = json_decode($presonJson);
		dump($presonArray);
		echo "<br>";
		echo "name:".$presonArray['name'];
		echo "<hr />";
		dump($presonObj);
		echo "<br>";
		echo "name:".$presonObj->name;
	}
	//创建xml
	public function createXML(){
		$str = '<?xml version="1.0" encoding="utf-8"?>';
		$str .="<preson>";
		$str .="<name>join</name>";
		$str .="<age>21</age>";
		$str .="<job>.net</job>";
		$str .="</preson>";
		$rs = file_put_contents('./preson.xml',$str);
		echo $rs;
	}
	//读取xml
	public function readXML(){
		$xmlStr = file_get_contents('./preson.xml');
		$xmlObj = simplexml_load_string($xmlStr);
		dump($xmlObj);
		echo "<hr/>";
		echo "name:".$xmlObj -> name;
	}
	//测试require方法,curl封装的类
	public function testRequire(){
		$url = 'www.baidu.com';
		$content = request($url);
		var_dump($content);
	}
	//天气查询
	public function weather(){
		$city = I('get.city');
		$url = 'http://api.map.baidu.com/telematics/v2/weather?location='.$city.'&ak=B8aced94da0b345579f481a1294c9094';
		$content = request($url,false);
		//dump($content);
		$contentObj = simplexml_load_string($content);
		//dump($contentObj);

		echo "当前城市是:".$contentObj -> currentCity.'<br/>';
		echo "当前日期是:".$contentObj -> results -> result[0] -> date.'<br/>';
		echo '<img src = "'.$contentObj -> results -> result[0] -> dayPictureUrl.'"/>';
		echo '<img src ="'.$contentObj -> results -> result[0] -> nightPictureUrl.'"/><br/>';
		echo "当前天气是:".$contentObj -> results -> result[0] -> weather.'<br/>';
		echo "当前风速是:".$contentObj -> results -> result[0] -> wind.'<br/>';
		echo "当前温度是:".$contentObj -> results -> result[0] -> temperature.'<br/>';
	}

	//电话号码归属地
	public function getAreaByPhone($phone){
		//接收传输过来的phon参数
		//$phone = I('get.phone');
		//1.url 地址
		$url = 'http://cx.shouji.360.cn/phonearea.php?number='.$phone;
		$content = request($url,false);
		//var_dump($content);
		$contentObj = json_decode($content);
		//dump($contentObj);
		echo "当前号码是:".$phone.'<br/>';
		echo "所属省份是:".$contentObj -> data -> province.'<br/>';
		echo "所属城市是:".$contentObj -> data -> city.'<br/>';
		echo "所属运营商:".$contentObj -> data -> sp.'<br/>';
	}
	//在客户列表里获取手机归属地
	public function customer(){
		$phone = I('get.phone');
		$this -> getAreaByPhone($phone);
	}
	//快递查询
	public function express(){
		$type = "yuantong";
		$postid = "807662601201";
		$url = "https://www.kuaidi100.com/query?type=".$type."&postid=".$postid;
		$content = request($url);
		//var_dump($content);
		$contentObj = json_decode($content);
		//var_dump($contentObj);
		foreach($contentObj->data as $key => $value){
			echo $value->time .'<br/>'.$value->context.'<hr/>';
		}
	}

	//邮件发送
	public function testSend(){
		$str = "登录微信公众平台官网后，在公众平台后台管理页面 - 开发者中心页，点击“修改配置”按钮，填写服务器地址（URL）、Token和EncodingAESKey，其中URL是开发者用来接收微信消息和事件的接口URL。Token可由开发者可以任意填写，用作生成签名（该Token会和接口URL中包含的Token进行比对，从而验证安全性）。EncodingAESKey由开发者手动填写或随机生成，将用作消息体加解密密钥。
	同时，开发者可选择消息加解密方式：明文模式、兼容模式和安全模式。模式的选择与服务器配置在提交后都会立即生效，请开发者谨慎填写及选择。加解密方式的默认状态为明文模式，选择兼容模式和安全模式需要提前配置好相关加解密代码，详情请参考消息体签名及加解密部分的文档。 ";
		$rs = sendMail('微信开发',$str,'1063183163@qq.com');
		if($rs === true){
			echo "发送成功";
		}else{
			echo "发送失败";
		}
	}
	//测试数据库
	public function testMysql(){
		$data = M('user') -> select();
		dump($data);
	}
	//测试截取字符串
	public function testStr(){
		$phone = '13053488270';
		$areaStr = substr($phone,1,7);
		echo $areaStr;
	}
	//测试文件是否存在
	public function testFile(){
		$fileName = './preson.text';
		if(file_exists($fileName)){
			$data = file_get_contents($fileName);
			dump($data);
		}else{
			echo "文件不存在!";
		}
	}


	//获取电话号码归属地通过MySQL
	/*public function getAreaByMysql(){
		$phone = I('get.phone');
		//参数校验
		if(empty($phone)){
			$dataArray = array(
				'errorcode' => '1',
				'time' => time(),
			);
			echo json_decode($dataArray);
		}
	}*/
	//获取ip
	public function testIp(){
		$ip = get_client_ip();
		echo $ip;
	}

}

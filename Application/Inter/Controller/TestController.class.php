<?php
/**
*
*文件名:TestController.class.php
* ==============================================
*文件用途
*
*
* ==============================================
* @添加时间: 2016年5月9日 上午10:28:36
* @作者: yaoyuan
* @版本：
*/
namespace Inter\Controller;

use Inter\Common\CommonController;
use Think\Exception;
use Think\Controller;
use Org\Net;
use Org\Net\Http;
use Common\Util\UUID;
use Think\Log;
use Inter\Common\InterfaceController;

/**
*类注释
*用途：
*@作者：yaoyuan
*@时间：2016年5月9日 上午10:30:36
*/
class TestController extends InterfaceController{
	/**
	* 用途:
	* @时间: 2016年5月9日 上午10:30:52
	* @作者: yaoyuan
	* @参数:
	* @返回:Json
	*/
	public function Test(){
		try{
			$response = array();
			$chk  = $this->legitimacyCheck();
			if($chk !== true){
				echo json_encode($chk);
				return;
			}
			
			$response['code'] = C('SUCCESS_CODE.CODE');
			$response['msg'] = C('SUCCESS_CODE.MSG');
			$response['content'] = "咱们的接口连通性OK了!";
			$response['timestamp'] = time();
			echo json_encode($response);
		}
		catch(Exception $ex){
			$this -> debug($ex->getMessage(), 'Excetpion');
		}
	}
	
	public function invok(){
		try{
			$timeStamp =  time();
			$signature = md5('@vipcar' . '@5b7e2ebd-f26a-d8e3-0893-fdef6efb2fa6' . 'iOS' . $timeStamp);
			$header = array("Content-type:text/html; charset=utf-8","SIGNATURE:" . $signature , "CLIENT:iOS" , "TIMESTAMP:".time());
			$response = Http::getResponse("http://web/myframework/inter/test/test", "" ,'GET' , $header);
			$this->debug($response, 'ResponseData');
			echo dump(json_decode($response , true));
		}
		catch(Exception $ex){
			$this -> debug($ex->getMessage(), 'Excetpion');
		}
	}
}


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
			$headers = $this->getRequestHeaders();
			$response['code']  = $this->legitimacyCheck($headers['signature'] , I('clientType') , I('timeStamp'));
			$this->debug($response, 'fuce');
// 			if(C('ERROR_CODE.CLIENT_TYPE_ERROR')['CODE'] == $response['code'] )
// 				$response['msg'] = C('ERROR_CODE.CLIENT_TYPE_ERROR')['MSG'];
			echo json_encode($response);
		}
		catch(Exception $ex){
			$this -> debug($ex->getMessage(), 'Excetpion');
		}
	}
	
	public function invok(){
		try{
			$timeStamp =  time();
			$signature = md5(C('PREFIX') . C('IOS_APP_KEY') . 'iOS' . $timeStamp);
			$header = array("Content-type:text/html; charset=utf-8","signatures:" . $signature);
			$response = Http::getResponse("http://web/myframework/inter/test/test", array('clientType' => 'iOS' , 'timeStamp' => $timeStamp) ,'GET' , $header);
			$this->debug($response, 'ResponseData');
		}
		catch(Exception $ex){
			$this -> debug($ex->getMessage(), 'Excetpion');
		}
	}
}


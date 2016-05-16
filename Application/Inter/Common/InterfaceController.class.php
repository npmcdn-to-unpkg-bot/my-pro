<?php

/**
 *
 *文件名:CommonController.class.php
 * ==============================================
 *文件用途
 *
 *
 * ==============================================
 * @添加时间: 2015年11月26日 下午10:50:13
 * @作者: yaoyuan
 * @版本：
 */
namespace Inter\Common;
require_once './PhpConsole/__autoload.php';

use Think\Controller;
use PhpConsole;
use Think\Exception;
use Think\Log;

class InterfaceController extends Controller {

	//Phpconsole调试句柄
	protected  $dh;
	
	public function _initialize() {
		//设置PhpConsole调试句柄
		if(C('Phpconsole')){
			if(!PhpConsole\Handler::getInstance() ->isStarted()){
				$this -> dh = PhpConsole\Handler::getInstance();
				$this -> dh -> start();
			}else
					$this -> dh = PhpConsole\Handler::getInstance();
		}
	}
	
	/**
	* 用途:调试方法
	* @时间: 2016年4月23日 上午10:18:41
	* @作者: yaoyuan
	* @参数:msg:调试信息    id:调试id
	* @返回:
	*/
	public function debug($msg , $id){
		try {
			if(C('Phpconsole'))
				$this -> dh -> debug($msg , $id);
		}
		catch(Exception $e){
			
		}
	}
	
	/**
	* 用途:去除收尾空格并过滤特殊字符
	* @时间: 2016年4月27日 上午10:31:39
	* @作者: yaoyuan
	* @参数:string
	* @返回:string
	*/
	public function trimAndHtmlSpecialChars($string){
		try{
			return trim(htmlspecialchars($string));
		}
		catch(Exception $ex){
			Log::write($ex->getMessage() , 'EMERG');
		}
	}
	
	/**
	* 用途:获取请求头
	* @时间: 2016年5月9日 上午11:36:36
	* @作者: yaoyuan
	* @参数:
	* @返回:array
	*/
	public function getRequestHeaders(){
		try{
			$headers = array();
			
			foreach ($_SERVER as $name => $value)
			{
// 				log::write("Header[".$name."]:".$value , "INFO");
				if (substr($name, 0, 5) == 'HTTP_')
				{
					$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
				}
			}
			log::write("Header:".json_encode($headers) , "INFO");
			return $headers;
		}
		catch(Exception $ex){
			Log::write($ex->getMessage() , 'EMERG');
		}
	}
	
	/**
	* 用途:客户端接口调用校验
	* @时间: 2016年5月12日 下午4:43:34
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function legitimacyCheck(){
		try{
			$headers = $this->getRequestHeaders();
			$clientType = $headers['Client'];
			$signature = $headers['Signature'];
			$timeStamp = $headers['Timestamp'];
			$appKey = $headers['Appkey'];
			//参数缺失
			if('' == trim($clientType) || null == trim($clientType) || '' == trim($signature) || null == trim($signature) || '' == trim($timeStamp) || null == trim($timeStamp) || '' == trim($appKey) || null == trim($appKey))
				return C('ERROR_CODE.VALIDATE_PARAM_EMPTY');
			
			//客户端类型校验
			if(C('IOS_CLIENT_TYPE') != $clientType && C('ANDROID_CLIENT_TYPE') != $clientType)
				return C('ERROR_CODE.CLIENT_TYPE_ERROR');
			
			//客户端类型判断-ios
			if(C('IOS_CLIENT_TYPE') == $clientType)
				$curAppk = C('IOS_APP_KEY');
			//客户端类型判断-android
			else if(C('ANDROID_CLIENT_TYPE') == $clientType)
				$curAppk = C('ANDROID_APP_KEY');

			//客户端暂用appkey校验
			$appKeyList = C('APPK_LIST');
			if(!array_key_exists($appKey, $appKeyList) && $appKey != md5($curAppk))
				return C('ERROR_CODE.APP_KEY_ILLEGAL');
			
			if(array_key_exists($appKey, $appKeyList)){
				if(!$appKeyList[$appKey]['USE'])
					return C('ERROR_CODE.APP_KEY_INVALID');
				$curAppk = $appKeyList[$appKey]['APP_KEY'];
			}
			
			//签名校验
			$mkSignature = md5(C('INTERFACE_AUTH_PREFIX') . $curAppk . $clientType . $timeStamp);
			if($signature != $mkSignature)
				return C('ERROR_CODE.SIGNATURE_ERROR');
			return true;
		}
		catch(Exception $ex){
			Log::write($ex->getMessage() , 'EMERG');
		}
	}
}


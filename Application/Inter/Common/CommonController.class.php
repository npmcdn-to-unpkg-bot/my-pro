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
use Admin\Model;

class CommonController extends Controller {

	//Phpconsole调试句柄
	protected  $dh;
	
	public function _initialize() {
		//获取接口分类
		$icModel = new \Admin\Model\IntCategoryModel();
		
		$assignData['icData'] = $icModel->getCategoryWithRelationship();
		
		$this->assign($assignData);
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
		catch(Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
}


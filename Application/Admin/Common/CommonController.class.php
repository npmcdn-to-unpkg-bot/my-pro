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
namespace Admin\Common;
require_once './PhpConsole/__autoload.php';

use Think\Controller;
use PhpConsole;
use Think\Exception;

class CommonController extends Controller {

	//Phpconsole调试句柄
	protected  $dh;
	
	public function _initialize() {
		// Admin模块页面合法访问控制
// 		echo 'MODULE NAME:' . MODULE_NAME . ",ACTION_NAME:" . ACTION_NAME . 'CONTR NAME:' . CONTROLLER_NAME;
		if (ACTION_NAME != "login" && ACTION_NAME != "adminValidate") {
			if (! session ( "?adminName" )) {
				$this->error ( '非法登录', __ROOT__.'/index/login', 3 );
			}
		}
		//获取菜单资源
		//获取管理员菜单资源
		$menuClass = new CommonMenu(session('adminKey'));
		$this -> assign("Menu" , $menuClass -> getMenu());

		//获取导航面包屑数据并赋值
		$this -> assign("BreadCrumb" , $menuClass->getMenuList(I("m_id")));
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


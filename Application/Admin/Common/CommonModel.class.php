<?php
/**
*
*文件名:CommonModel.class.php
* ==============================================
*文件用途
*
*
* ==============================================
* @添加时间: 2016年4月23日 上午10:13:07
* @作者: yaoyuan
* @版本：
*/
namespace Admin\Common;
require_once './PhpConsole/__autoload.php';

use Think\Model;
use PhpConsole;
use Think\Exception;

class CommonModel extends Model{

	/*
	*Phpconsole调试句柄
	*/
	private $dh;
	
	public function _initialize(){
		try{
			//设置PhpConsole调试句柄
			if(C('Phpconsole')){
				if(!PhpConsole\Handler::getInstance() ->isStarted()){
					$this -> dh = PhpConsole\Handler::getInstance();
					$this -> dh -> start();
				}
				else
					$this -> dh = PhpConsole\Handler::getInstance();
			}
		}
		catch(Exception $e){
			
		}
	}
	
	
	/**
	* 用途:构造函数，调用父类构造函数
	* @时间: 2016年4月23日 上午10:17:51
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function __construct(){
		try{
			parent::__construct($name='',$tablePrefix='',$connection='');
		}
		catch (Exception $e){
			
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
}
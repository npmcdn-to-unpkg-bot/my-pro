<?php
/**
*
*文件名:indexController.class.php
* ==============================================
*文件用途
*
*
* ==============================================
* @添加时间: 2016年5月7日 上午10:50:26
* @作者: yaoyuan
* @版本：
*/
namespace Inter\Controller;

use Inter\Common\CommonController;
use Think\Exception;
use Think\Page;
use Think\Controller;
use Admin\Model;

/**
*类注释
*用途：
*@作者：yaoyuan
*@时间：2016年5月7日 上午10:50:36
*/
class IndexController extends CommonController{
	
	/*
	*Interface Category Model
	*/
	private $icModel;
	
	/*
	*interface Model
	*/
	private $intModel;
	
	/**
	* 用途:构造函数
	* @时间: 2016年5月7日 上午11:25:31
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function __construct(){
		try{
			parent::__construct();
			//实例化接口分类模型
			$this->icModel = new \Admin\Model\IntCategoryModel();
			//实例化接口模型
			$this->intModel = new \Admin\Model\InterModel();
		}
		catch(Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:
	* @时间: 2016年5月7日 上午10:50:50
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function document(){
		try{
			$assignData['PAGE_FROM'] = 'Index';
			
			$where = "(STATE = '00A')";
			//拼接查询字符串
			foreach(I('get.') as $key => $item)
			{
				if("m_id" == $key || 'p_id' == $key || "" == trim($item) || "p" == $key)
					continue;
				else
					$where .= " and " . $key . " like '%".$item."%'";
			}
				
			$pageInfo ['Count'] = $this -> intModel ->where ( $where)->count ();
			$page = new Page ( $pageInfo ['Count'], 10 );
			$assignData ['pageData'] = $page->show ();
			$assignData ['list'] = $this -> intModel ->where ( $where )->order ( 'update_time desc' )->page ( I ( 'p' ), 10 )->select ();
			$this->debug($assignData, 'data');
			$this->assign($assignData);
			$this->display();
		}
		catch(Exception $ex){
			$this->debug($ex->getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:
	* @时间: 2016年5月7日 下午10:32:19
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function interDetails(){
		try{
			$assignData['CODE'] = true;
			$assignData['intData'] = $this->intModel->getInterfaceById(I('id'));
			$this->assign($assignData);
			$this->display();
		}
		catch(Exception $ex){
			$this->debug($ex->getMessage(), 'Exception');
		}
	}
	/**
	* 用途:
	* @时间: 2016年5月7日 上午11:54:24
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function InterList(){
		try{
			
		}
		catch(Exception $ex){
			$this->debug($ex->getMessage(), 'Exception');
		}
	}
}
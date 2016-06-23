<?php
/**
*
*文件名:IntCategroyController.class.php
* ==============================================
*文件用途
*接口类型管理控制器
*
* ==============================================
* @添加时间: 2016年4月21日 下午11:48:23
* @作者: yaoyuan
* @版本：
*/
namespace Admin\Controller;


use Admin\Common\CommonController;
use Think\Exception;
use Common\Util;
use Think\Page;
use Think\Controller;
use Common\Util\UUID;
use Admin\Model;


/**
*类注释
*用途：接口管理控制器类定义
*@作者：yaoyuan
*@时间：2016年4月21日 下午11:52:34
*/
class IntCategoryController extends CommonController{
	
	//接口分类模型
	private  $categoryModel;
	
	/**
	* 用途:
	* @时间: 2016年4月25日 上午11:56:58
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function __construct(){
		try{
			parent::__construct();
			$this -> categoryModel = new \Admin\Model\IntCategoryModel();//D('IntCategory');
		}
		catch(Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
	/**
	* 用途:加载接口分类列表界面
	* @时间: 2016年4月22日 下午10:56:17
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	function viewList(){
		try{
			$assignData ['PAGE_FROM'] = "List";
			//查询条件-搜索或者直接显示列表
			$where = "(STATE = '00A')";
			//拼接查询字符串
			foreach(I('get.') as $key => $item)
			{
				if("m_id" == $key || 'p_id' == $key || "" == trim($item) || "p" == $key)
					continue;
				else
					$where .= " and " . $key . " like '%".$item."%'";
			}
			
			$pageInfo ['Count'] = $this -> categoryModel ->where ( $where)->count ();
			$page = new Page ( $pageInfo ['Count'], 10 );
			$assignData ['pageData'] = $page->show ();
			$assignData ['list'] = $this -> categoryModel ->where ( $where )->order ( 'sort desc' )->page ( I ( 'p' ), 10 )->select ();
			
			$this -> assign($assignData);
			$this -> display();
		}
		catch(Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:
	* @时间: 2016年4月22日 下午11:09:14
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	function viewAdd(){
		try{
			$assignData ['PAGE_FROM'] = "Add";
			//获取父级分类
			$assignData['main_category'] = $this -> categoryModel -> where("pid is null and state = '00A'") -> select();
			$this->assign ( $assignData );
			$this->display ();
		}
		catch (Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:
	* @时间: 2016年4月25日 下午5:03:18
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	function viewModify(){
		try{
			$assignData ['PAGE_FROM'] = "Add";
			//获取父级分类
			$assignData['main_category'] = $this -> categoryModel -> where("pid is null and state = '00A' and id <> '".I('id')."'") -> select();
			//获取当前填充数据
			$assignData['data'] = $this -> categoryModel -> getIntCategoryById(I('id'));
			$this -> assign($assignData);
			$this -> display();
		}
		catch(Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:创建数据
	* @时间: 2016年4月25日 上午11:19:03
	* @作者: yaoyuan
	* @参数:
	* @返回:null
	*/
	public function add(){
		try{
			$data ['ID'] = UUID::getUUID();
			
			$data ['SORT'] = I( 'sort' );
			$data ['STATE'] = "00A";
			$data ['CREATE_TIME'] = date ( 'Y-m-d H:i:s', time () );
			$data['DISCRIPTION'] = $this -> trimAndHtmlSpecialChars(I('discription'));
			$data ['NAME'] = $this -> trimAndHtmlSpecialChars(I( 'category_name' ));
			if ("none" == I ( 'pid' )) {
				$data ['PID'] = NULL;
				$data ['PNAME'] = NULL;
			} else {
				$data ['PID'] = explode ( "/", I ( 'pid' ) )[0];
				$data ['PNAME'] = explode ( "/", I ( 'pid' ) )[1];
			}
			
			if ($this -> categoryModel -> add($data)) {
				$this->success ( "添加成功", __ROOT__."/".CONTROLLER_NAME."/viewList" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
			}
		}
		catch(Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
	
	/**
	 * 用途:创建数据
	 * @时间: 2016年4月25日 上午11:19:03
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:null
	 */
	public function modify(){
		try{
			$data ['ID'] = I( 'id' );
				
			$data ['SORT'] = I( 'sort' );
			$data ['NAME'] = $this -> trimAndHtmlSpecialChars(I( 'category_name' ));
			$data['DISCRIPTION'] = $this -> trimAndHtmlSpecialChars(I('discription'));
			if ("none" == I ( 'pid' )) {
				$data ['PID'] = NULL;
				$data ['PNAME'] = NULL;
			} else {
				$data ['PID'] = explode ( "/", I ( 'pid' ) )[0];
				$data ['PNAME'] = explode ( "/", I ( 'pid' ) )[1];
			}
			if ($this -> categoryModel -> save($data)) {
				$this->success ( "修改成功", __ROOT__."/".CONTROLLER_NAME."/viewList" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
			}
		}
		catch(Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:删除分类
	* @时间: 2016年4月25日 下午10:04:57
	* @作者: yaoyuan
	* @参数:id
	* @返回:null
	*/
	public function delete(){
		try{
			if("top" == $this -> categoryModel-> deleteData(I('id')))
				$this -> error("你所删除的分类中包含子类，请确认该分类下无有效子类再删除" , __ROOT__."/".CONTROLLER_NAME."/viewList" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 3 );
			else if(false === $this -> categoryModel-> deleteData(I('id')))
				$this -> error("删除失败，请联系管理员解决问题" , __ROOT__."/".CONTROLLER_NAME."/viewList" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 3 );
			else 
				$this->success ( "删除成功", __ROOT__."/".CONTROLLER_NAME."/viewList" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
		}
		catch(Exception $ex){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
}
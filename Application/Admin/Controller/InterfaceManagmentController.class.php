<?php
/**
*类注释
*用途：
*@作者：yaoyuan
*@时间：2016年4月27日 下午3:06:47
*/

namespace Admin\Controller;

use Admin\Common\CommonController;
use Think\Exception;
use Think\Page;
use Think\Controller;
use Common\Util\UUID;
use Admin\Model\InterfaceModel;
use Admin\Model\IntCategoryModel;

class InterfaceManagmentController extends CommonController{
	
	/*
	*接口分类模型
	*/
	private $cateModel;
	
	/*
	*接口管理模型
	*/
	private $intModel;
	
	/*
	*参数管理模型
	*/
	private $paramModel;
	
	/*
	*ErrorCode模型
	*/
	private  $ecModel;
	
	/**
	* 用途:构造函数
	* @时间: 2016年4月27日 下午3:28:13
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function __construct(){
		try{
			parent::__construct();
			//实例化接口分类模型
			$this -> cateModel = new \Admin\Model\IntCategoryModel();
			//实例化接口管理模型
			$this -> intModel = new \Admin\Model\InterModel();
			//实例化参数管理模型
			$this -> paramModel = new \Admin\Model\ParamsModel();
			//实例化ErrorCode模型
			$this->ecModel = new \Admin\Model\ErrorCodeModel();
		}
		catch(Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:
	* @时间: 2016年4月27日 下午3:10:22
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function viewList(){
		try{
			$assignData ['PAGE_FROM'] = "List";
			//查询条件-搜索或者直接显示列表
			$where = "(STATE = '00A' or STATE = '00B')";
			//拼接查询字符串
			foreach(I('get.') as $key => $item)
			{
				if("m_id" == $key || 'p_id' == $key || "" == trim($item) || "p" == $key)
					continue;
				else if("PID" == $key)
					$where .= "and " . $key . " " . $item;
				else
					$where .= " and " . $key . " like '%".$item."%'";
			}
			
			$pageInfo ['Count'] = $this -> intModel ->where ( $where)->count ();
			$page = new Page ( $pageInfo ['Count'], 10 );
			$assignData ['pageData'] = $page->show ();
			$assignData ['list'] = $this -> intModel ->where ( $where )->order ( 'sort desc' )->page ( I ( 'p' ), 10 )->select ();
			
			$this -> assign($assignData);
			$this -> display();
		}
		catch(Exception $e){
			$this -> debug($e -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:跳转修改界面
	* @时间: 2016年5月3日 下午2:09:41
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function viewModify(){
		try{

			if(!$this->intModel->isAuthor(I('id')))
				$this->error("不能修改他人发布的接口信息",U('viewList' , array('m_id' => I('m_id'), 'p_id'  => I('p_id'), true)) , 2);
			
			$assignData['PAGE_FROM'] = 'Add';
			$assignData['EDIT'] = true;
			$assignData['data'] = $this -> intModel -> getInterfaceById(I('id'));
			$assignData['catData'] = $this -> cateModel -> getCategoryWithRelationship();
			$this -> assign($assignData);
			$this -> display();
		}
		catch(Exception $ex){
			$this -> debug($e -> getMessage(), 'Exception'); 
		}
	}
	
	/**
	* 用途:
	* @时间: 2016年4月27日 下午3:20:24
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function viewAdd(){
		try{
			$assignData['PAGE_FROM'] = 'Add';
			$assignData['id'] = UUID::getUUID();
			$assignData['EDIT'] = true;
			$assignData['catData'] = $this -> cateModel -> getCategoryWithRelationship();
			
			$this -> assign($assignData);
			$this -> display();
		}
		catch(Exception $e){
			$this -> debug($e->getMessage(), 'Exception');
		}
	}

	/**
	* 用途:修改指定接口基础洗向你
	* @时间: 2016年5月3日 下午2:47:22
	* @作者: yaoyuan
	* @参数:$id,array
	* @返回:
	*/
	public function modify(){
		try{
			$data ['ID'] = I('id');
			
			$data['NAME'] = $this -> trimAndHtmlSpecialChars(I('name'));
			if ("none" != I ( 'category' )) {
				$data ['CATEGORY_ID'] = explode ( "/", I ( 'category' ) )[0];
				$data ['CATEGORY_NAME'] = explode ( "/", I ( 'category' ) )[1];
			}
			$data['INT_METHOD'] = I('method');
			$data['URL'] = $this -> trimAndHtmlSpecialChars(I('url'));
			$data['TEST_URL'] = $this -> trimAndHtmlSpecialChars(I('testUrl'));
			$data['DEMO_IN'] = I('demoIn');
			$data['DEMO_OUT'] = I('demoOut');
// 			$data['AUTHOR'] = $this -> trimAndHtmlSpecialChars(I('author'));
			$data ['SORT'] = I( 'sort' );
			$data['DISCRIPTION'] = $this -> trimAndHtmlSpecialChars(I('discription'));
			$data['REMARK'] = $this -> trimAndHtmlSpecialChars(I('remark'));
			$data ['UPDATE_TIME'] = date ( 'Y-m-d H:i:s', time () );
			if ($this -> intModel -> save($data)) {
				$this->success ( "修改成功", __ROOT__."/".CONTROLLER_NAME."/viewList" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
			}
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), 'Exception');
		}
	}

	/**
	* 用途:新增接口信息
	* @时间: 2016年4月30日 下午9:07:49
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function add(){
		try{
			
			$data ['ID'] = UUID::getUUID();
			
			$data['NAME'] = $this -> trimAndHtmlSpecialChars(I('name'));
			if ("none" != I ( 'category' )) {
				$data ['CATEGORY_ID'] = explode ( "/", I ( 'category' ) )[0];
				$data ['CATEGORY_NAME'] = explode ( "/", I ( 'category' ) )[1];
			} 
			$data['INT_METHOD'] = I('method');
			$data['URL'] = $this -> trimAndHtmlSpecialChars(I('url'));
			$data['TEST_URL'] = $this -> trimAndHtmlSpecialChars(I('testUrl'));
			$data['DEMO_IN'] = I('demoIn');
			$data['DEMO_OUT'] = I('demoOut');
			$this->debug(session('adminName'), 'adminname');
			$data['AUTHOR'] = session('adminName');//$this -> trimAndHtmlSpecialChars(I('author'));
			$data['AUTHOR_ID'] = session('adminKey');
			$data ['SORT'] = I( 'sort' );
			$data['DISCRIPTION'] = $this -> trimAndHtmlSpecialChars(I('discription'));
			$data['REMARK'] = $this -> trimAndHtmlSpecialChars(I('remark'));
			
			
			$data ['STATE'] = "00A";
			$data ['CREATE_TIME'] = date ( 'Y-m-d H:i:s', time () );
			$data ['UPDATE_TIME'] = date ( 'Y-m-d H:i:s', time () );
			
			if ($this -> intModel -> add($data)) {
				$this->success ( "添加成功", __ROOT__."/".CONTROLLER_NAME."/viewList" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
			}
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), "Excecption");
		}
	}
	
	/**
	* 用途:根据ID逻辑删除接口
	* @时间: 2016年5月6日 下午10:17:36
	* @作者: yaoyuan
	* @参数:id:接口id
	* @返回:
	*/
	public function deleteInterface(){
		try{
			if(!$this->intModel->isAuthor(I('id')))
				$this->error("不能删除他人发布的接口信息",U('viewList' , array('m_id' => I('m_id'), 'p_id'  => I('p_id'), true)) , 2);
			
			if(empty(I('id')))
				$this->error("删除接口参数错误" , U('viewList' , array('m_id' => I('m_id'), 'p_id'  => I('p_id'), true)) , 2);
			
			if($this->intModel->deleteInterface(I('id')))
				$this->success("删除接口成功" , U('viewList' , array('m_id' => I('m_id'), 'p_id'  => I('p_id'), true)) , 2);
			else 
				$this->error("删除接口失败" , U('viewList' , array('m_id' => I('m_id'), 'p_id'  => I('p_id'), true)) , 2);
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), "Excecption");
		}
	}
	
	/**
	* 用途:管理接口参数
	* @时间: 2016年5月3日 下午4:18:39
	* @作者: yaoyuan
	* @参数:type:paramIn(入参管理);paramOut(返回参数管理);errorCode(错误码管理)
	* @返回:参数管理页面
	*/
	public function interParams(){
		try{

			if(!$this->intModel->isAuthor(I('intId')))
				$this->error("不能修改他人发布的接口信息",U('viewList' , array('m_id' => I('m_id'), 'p_id'  => I('p_id'), true)) , 2);
			
			$assignData['PAGE_FROM'] = 'Add';
			$assignData['type'] = I('type');
			$assignData['paramDatas'] =  $this -> paramModel -> getParamsByInterId(I('intId'));
			$assignData['intId'] = I('intId');
			$assignData['intData'] = $this->intModel->getInterfaceById(I('intId'));
			$assignData['ecDatas'] = $this->ecModel->getErrorCodeDatasByIntId(I('intId'));
			
			if(!empty(I('paramInId'))){
				$assignData['paramInData'] = $this->paramModel->getParamByParamId(I('paramInId'));
				$assignData['paramInId'] = I('paramInId');
			}
			if(!empty(I('paramOutId'))){
				$assignData['paramOutData'] = $this->paramModel->getParamByParamId(I('paramOutId'));
				$assignData['paramOutId'] = I('paramOutId');
			}
			if(!empty(I('ecId'))){
				$assignData['ecData'] = $this->ecModel->getErrorCodeById(I('ecId'));
				$assignData['ecId'] = I('ecId');
			}
			$this->assign($assignData);
			$this->display();
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), "Excecption");
		}
	}
	
	/**
	* 用途:入参参数操作方法
	* @时间: 2016年5月4日 下午5:01:50
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function paramInOpration(){
		try{
			//如果为传入参数id，执行新建参数操作
			if('' == I('paramId') && false !== $this->paramModel->paramAdd(I()))
				$this->success ( "添加参数成功", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => I('type'))), 1 );
			else if(false !== $this->paramModel->paramModify(I()))
				$this->success ( "修改参数成功", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => I('type'))), 1 );
			else 
				$this->error ( "修改或添加参数失败", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => I('type'))), 1 );
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), "Excecption");
		}
	}
	
	/**
	* 用途:errorcode操作
	* @时间: 2016年5月6日 下午4:13:11
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function errorCodeOpration(){
		try{
			if(empty(I('ecId')) && $this->ecModel->errorCodeAdd(I()))
				$this->success ( "添加Code成功", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => "errorCode")), 1 );
			else if($this->ecModel->errorCodeModify(I()))
				$this->success ( "修改Code成功", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => "errorCode")), 1 );
			else 
				$this->error ( "修改或添加Code失败", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => "errorCode")), 1 );
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), "Excecption");
		}
	}
	
	/**
	* 用途:删除参数
	* @时间: 2016年5月5日 下午5:37:55
	* @作者: yaoyuan
	* @参数:id:参数ID,逻辑删除
	* @返回:
	*/
	public function deleteParam(){
		try{
			if('' == I('paramId') || null == I('paramId'))
				$this->error( "参数传入错误", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => I('type'))), 1 );
			if($this->paramModel->deleteParam(I('paramId') , I('intId')))
				$this->success ( "删除成功", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => I('type'))), 1 );
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), "Excecption");
		}
	}
	
	/**
	* 用途:根据ErrorCode id 删除ErrorCode
	* @时间: 2016年5月6日 下午4:53:15
	* @作者: yaoyuan
	* @参数:id : error code id
	* @返回:
	*/
	public function deleteErrorCode(){
		try{
			if(empty(I('ecId')))
				$this->error( "参数传入错误", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => I('type'))), 1 );
			if($this->ecModel->deleteErrorCode(I('ecId') , I('intId')))
				$this->error( "删除Code成功", U('interParams' , array('m_id' => I('m_id') , 'p_id' => I('p_id') , 'intId' => I('intId') , 'type' => I('type'))), 1 );
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), "Excecption");
		}
	}

	/**
	* 用途:查看接口详情
	* @时间: 2016年5月7日 下午6:13:53
	* @作者: yaoyuan
	* @参数:$id 接口id
	* @返回:
	*/
	public function viewDetails(){
		try{
			$assignData['PAGE_FROM'] = 'Add';
			$assignData['intData'] = $this -> intModel -> getInterfaceById(I('id'));
			$assignData['paramDatas'] =  $this -> paramModel -> getParamsByInterId(I('id'));
			$assignData['ecDatas'] = $this->ecModel->getErrorCodeDatasByIntId(I('id'));
			
			$this->assign($assignData);
			$this->display();
		}
		catch(Exception $ex){
			$this->debug($ex-> getMessage(), 'Excetpion');
		}
	}
}
<?php
/**
*
*文件名:ErrorCodeModel.class.php
* ==============================================
*文件用途
*
*
* ==============================================
* @添加时间: 2016年5月6日 下午4:11:25
* @作者: yaoyuan
* @版本：
*/
namespace Admin\Model;

use Think\Model;
use Admin\Common\CommonModel;
use Common\Util\UUID;
use Think\Exception;

/**
*类注释
*用途：
*@作者：yaoyuan
*@时间：2016年5月6日 下午4:11:32
*/
class ErrorCodeModel extends CommonModel{
	
	/*
	*接口模型
	*/
	private $intModel;
	
	/*
	*自定义数据库标明
	*/
	protected $tableName = 'int_error_code';
	

	/**
	 * 用途:构造函数
	 * @时间: 2016年5月7日 下午6:06:08
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function __construct(){
		try{
			parent::__construct();
			//实例化接口模型
			$this->intModel = new \Admin\Model\InterModel();
		}
		catch(Exception $ex){
			$this->debug($ex->getMessage(), 'Exception');
		}
	}
	
	
	/**
	* 用途:新建Errorcode
	* @时间: 2016年5月6日 下午4:15:53
	* @作者: yaoyuan
	* @参数:I()
	* @返回:boolean
	*/
	public function errorCodeAdd($i){
		try{
			
			$data['ID'] = UUID::getUUID();
			$data['CODE_NAME'] = trim(htmlspecialchars($i['ecName']));
			$data['CODE_MSG'] = trim(htmlspecialchars($i['ecMsg']));
			$data['SORT'] = $i['ecSort'];
			$data['DISCRIPTION'] = trim(htmlspecialchars($i['discription']));
			$data['CREATE_TIME'] = date ( 'Y-m-d h:i:s', time () );
			$data['STATE'] = '00A';
			$data['YYBG_INT_INFO_ID'] = $i['intId'];
			
			$intData['ID'] = $i['intId'];
			$intData['UPDATE_TIME'] = date ( 'Y-m-d h:i:s', time () );
			
			$this->intModel->save($intData);
			
			if(false === $this->add($data))
				return false;
			else return true;
		}
		catch(Exception $ex){
			$this->debug($ex->getMessage(), 'Excetpion');
		}
	}
	
	/**
	* 用途:根据接口ID获取其ErrorCode数据集
	* @时间: 2016年5月6日 下午4:37:31
	* @作者: yaoyuan
	* @参数:intId 接口id
	* @返回:array
	*/
	public function getErrorCodeDatasByIntId($intId){
		try {
			$where = "STATE = '00A' and YYBG_INT_INFO_ID = '".$intId."'";
			return $this->where($where)->order("sort desc")->select();
		}
		catch(Exception $ex){
			$this->debug($ex->getMessage(), 'Excetpion');
		}
	}

	/**
	* 用途:根据ErrorCode id获取单条信息
	* @时间: 2016年5月6日 下午4:42:08
	* @作者: yaoyuan
	* @参数:id :errorcode id
	* @返回:array
	*/
	public function getErrorCodeById($id){
		try{
			$where = "ID='".$id."'";
			return $this->where($where)->find();
		}
		catch(Exception $ex){
			$this->debug($ex->getMessage(), 'Excetpion');
		}
		
	}
	
	/**
	* 用途:修改ErrorCode
	* @时间: 2016年5月6日 下午5:10:53
	* @作者: yaoyuan
	* @参数:I()
	* @返回:boolean
	*/
	public function errorCodeModify($i){
		try{
			$data['ID'] = $i['ecId'];
			$data['CODE_NAME'] = trim(htmlspecialchars($i['ecName']));
			$data['CODE_MSG'] = trim(htmlspecialchars($i['ecMsg']));
			$data['SORT'] = $i['ecSort'];
			$data['DISCRIPTION'] = trim(htmlspecialchars($i['discription']));
			
			$intData['ID'] = $i['intId'];
			$intData['UPDATE_TIME'] = date ( 'Y-m-d h:i:s', time () );
				
			$this->intModel->save($intData);
				
			
			if(false === $this->save($data))
				return false;
			else return true;
		}
		catch(Exception $ex){
			$this->debug($ex->getMessage(), 'Excetpion');
		}
	}
	
	/**
	* 用途:根据ErrorCode id 逻辑删除Error Code
	* @时间: 2016年5月6日 下午4:54:29
	* @作者: yaoyuan
	* @参数:id : error code 
	* @返回:boolean
	*/
	public function deleteErrorCode($id , $intId){
		try {
			$data['ID'] = $id;
			$data['STATE'] = '00B';
			$intData['ID'] = $intId;
			$intData['UPDATE_TIME'] = date ( 'Y-m-d h:i:s', time () );
				
			$this->intModel->save($intData);
			if(false === $this->save($data))
				return false;
			else return true;
		}
		catch(Exception $ex){
			$this->debug($ex->getMessage(), 'Excetpion');
		}
	}
}
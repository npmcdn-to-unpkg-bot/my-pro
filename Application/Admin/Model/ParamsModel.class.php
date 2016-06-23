<?php
/**
*
*文件名:ParamsModel.class.php
* ==============================================
*文件用途
*
*
* ==============================================
* @添加时间: 2016年4月27日 下午8:19:05
* @作者: yaoyuan
* @版本：
*/
namespace Admin\Model;
use Admin\Common\CommonModel;
use Think\Exception;
use Common\Util\UUID;
use Think\Model;

/**
*类注释
*用途：
*@作者：yaoyuan
*@时间：2016年4月27日 下午8:18:56
*/
class ParamsModel extends CommonModel{
	
	private $intModel;
	
	/**
	* 用途:构造函数
	* @时间: 2016年5月7日 下午5:58:45
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
			$this->debug($ex -> getMessage(), 'Exception');
		}
	}
	/**
	* 用途:新建参数
	* @时间: 2016年5月4日 下午5:12:44
	* @作者: yaoyuan
	* @参数:$data:array 
	* @返回:
	*/
	public function paramAdd($i){
		try{
			$data['ID'] = UUID::getUUID();
			$data['YYBG_INT_INFO_ID'] = $i['intId'];
			$data['NAME'] = trim(htmlspecialchars($i['paramInName']));
			$data['PARAM_TYPE'] = $i['paramInType'];
			$data['PARAM_LOC'] = $i['paramInLoc'];
			$data['SORT'] = $i['paramInSort'];
			$data['MUST'] = $i['paramInMust'];
			$data['PARAM_DIC'] = $i['paramDic'];
			$data['STATE'] = '00A';
			$data['DISCRIPTION'] = trim(htmlspecialchars($i['discription']));
			$data['JSON_DISCRIPTION'] = trim(htmlspecialchars($i['paramInJsonDis']));
			$data ['CREATE_TIME'] = date ( 'Y-m-d H:i:s', time () );
			
			$intData['ID'] = $i['intId'];
			$intData['UPDATE_TIME'] = date ( 'Y-m-d H:i:s', time () );
			return ($this -> add($data) && $this->intModel -> save($intData));			
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), 'Exception');
		}
	}

	public function paramModify($i){
		try {
			$data['ID'] = $i['paramId'];
			$data['NAME'] = trim(htmlspecialchars($i['paramInName']));
			$data['PARAM_TYPE'] = $i['paramInType'];
			$data['PARAM_LOC'] = $i['paramInLoc'];
			$data['SORT'] = $i['paramInSort'];
			$data['MUST'] = $i['paramInMust'];
			$data['DISCRIPTION'] = trim(htmlspecialchars($i['discription']));
			$data['JSON_DISCRIPTION'] = trim(htmlspecialchars($i['paramInJsonDis']));
			
			$intData['ID'] = $i['intId'];
			$intData['UPDATE_TIME'] = date ( 'Y-m-d H:i:s', time () );
			return ($this -> save($data) && $this->intModel -> save($intData));
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:逻辑删除参数
	* @时间: 2016年5月5日 下午5:39:05
	* @作者: yaoyuan
	* @参数:$id 参数ID
	* @返回:boolean
	*/
	public function deleteParam($id , $intId){
		try{
			$data['ID'] = $id;
			$data['STATE'] = '00B';
			
						
			$intData['ID'] = $intId;
			$intData['UPDATE_TIME'] = date ( 'Y-m-d H:i:s', time () );
			$this->intModel -> save($intData);
			
			if(false !== $this->save($data))
				return true;
			else 
				return false;
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:通过参数类型以及接口ID获取对应的参数列表
	* @时间: 2016年5月4日 下午5:06:06
	* @作者: yaoyuan
	* @参数:$type:00A 入参  00B 出参；$intID:接口ID
	* @返回:array
	*/
	public function getParamsByTypeAndInterId($type , $intId){
		try{
			$where = "STATE = '00A' and YYBG_INT_INFO_ID = '".$intId."'";
			return $this -> where($where) -> order('sort desc') -> select();
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), 'Exception');
		}
	}

	/**
	* 用途:根据参数ID获取参数数据
	* @时间: 2016年5月5日 下午11:34:16
	* @作者: yaoyuan
	* @参数:$id:参数ID
	* @返回:array
	*/
	public function getParamByParamId($id){
		try{
			$where = "ID = '" . $id . "'";
			return $this -> where($where) -> find();
		}
		catch (Exception $ex){
			$this -> debug($ex -> getMessage(), 'Exception');
		}
	}
	
	/**
	* 用途:根据接口ID获取对应的参数、错误码列表
	* @时间: 2016年5月5日 下午10:26:11
	* @作者: yaoyuan
	* @参数:intID：接口ID
	* @返回:data
	*/
	public function getParamsByInterId($intId){
		try{
			$data = array();
			$where = "STATE = '00A' and YYBG_INT_INFO_ID = '".$intId."' and param_dic='00A'";
			$data['paramIn'] = $this -> where($where) -> order('sort desc') -> select();
			$where = "STATE = '00A' and YYBG_INT_INFO_ID = '".$intId."' and param_dic='00B'";
			$data['paramOut'] = $this -> where($where) -> order('sort desc') -> select();
			return $data;
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), 'Exception');
		}
	}
}
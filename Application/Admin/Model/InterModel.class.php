<?php
/**
*类注释
*用途：
*@作者：yaoyuan
*@时间：2016年4月27日 下午3:08:06
*/
namespace Admin\Model;

use Common\Util;
use Admin\Common\CommonModel;
use Think\Exception;

class InterModel extends CommonModel{
	
	/*
	*自定义数据库表明
	*/
	protected  $tableName = 'int_info';
	
	/**
	* 用途:通过接口ID获取接口信息
	* @时间: 2016年5月3日 下午2:11:27
	* @作者: yaoyuan
	* @参数:$id:接口id
	* @返回:array
	*/
	public function getInterfaceById($id){
		try{
			$ret = $this -> where("ID='".$id."'") -> find();
			$ret['demo_in'] = htmlspecialchars_decode($ret['demo_in']);
			$ret['demo_out'] = htmlspecialchars_decode($ret['demo_out']);
			return  $ret;
		}
		catch(Exception $ex){
			$this -> debug($ex -> getMessage(), 'Exception');
		}
	}


	/**
	 * 用途:根据接口id获取当前接口信息是否是当前用户所发布
	 * @时间: 2016年5月6日 下午10:01:06
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:boolean
	 */
	public function isAuthor($id){
		try{
			$data = $this->where("ID='".$id."'")->find();
			if(0 == count($data) || null == $data || empty($data) || $data['author_id'] != session('adminKey'))
				return false;
			return true;
		}
		catch(Exception $ex){
			$this->debug($ex -> getMessage(), 'Exception');
		}
	}

	/**
	* 用途:根据接口ID逻辑删除接口
	* @时间: 2016年5月6日 下午10:20:29
	* @作者: yaoyuan
	* @参数:id:接口id
	* @返回:boolean
	*/
	public function deleteInterface($id){
		try{
			$data['ID'] = $id;
			$data['STATE'] = '00C';
			if($this->save($data))
				return true;
			return false;
		}
		catch(Exception $ex){
			$this->debug($ex -> getMessage(), 'Exception');
		}
	}
}

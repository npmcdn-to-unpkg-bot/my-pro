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
}

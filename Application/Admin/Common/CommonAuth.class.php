<?php
/**
*类注释
*用途：授权操作
*@作者：yaoyuan
*@时间：2015年12月24日 上午5:11:19
*/

namespace Admin\Common;

class CommonAuth{
	
	//授权数据库操作model
 	private $authModel;
 	
 	
 	/**
 	* 用途:
 	* @时间: 2015年12月24日 上午5:14:56
 	* @作者: yaoyuan
 	* @参数:
 	* @返回:
 	*/
 	public function __construct(){
 		$this -> authModel = M("auth");
 	}
 	
 	/**
 	* 用途:检查指定ID是否已被授权给指定的角色
 	* @时间: 2015年12月24日 上午5:16:22
 	* @作者: yaoyuan
 	* @参数:$menu_id:被查找的菜单资源ID 
 	* @参数:$role_id:被查找的角色ID
 	* @返回:true/false
 	*/
 	public function isMenuChecked($menu_id , $role_id)
 	{
 		try {
 			$authData = $this -> authModel -> where("RES_ID = '" . $menu_id . "' and ROLE_ID = '" . $role_id ."'") -> find();
 			if(0 == count($authData))
 				return false;
 			else
 				return true;
 		} catch (Exception $e) {
 			throw new Exception($e ->getMessage(), $e ->getCode, $e -> getPrevious());
 		}
 	}
}
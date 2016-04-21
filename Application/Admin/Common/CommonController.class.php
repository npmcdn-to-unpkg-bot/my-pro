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

use Think\Controller;

class CommonController extends Controller {
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
	}
}


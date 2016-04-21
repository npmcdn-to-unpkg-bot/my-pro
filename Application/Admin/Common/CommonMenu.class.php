<?php

/**
 *类注释
 *用途：菜单资源类
 *@作者：yaoyuan
 *@时间：2015年11月30日 下午8:50:01
 */
namespace Admin\Common;

class CommonMenu {
	/*
	 * 管理员主键
	 */
	private $adminId;
	
	/**
	 * 用途:构造函数，初始化管理员主键
	 * @时间: 2015年11月30日 下午8:56:36
	 * @作者: yaoyuan
	 * @参数:$adminId
	 * @返回:null
	 */
	public function __construct($adminId) {
		$this->adminId = $adminId;
	}
	
	/**
	 * 用途:获取被结构化的菜单资源
	 * @时间: 2015年11月30日 下午8:56:29
	 * @作者: yaoyuan
	 * @参数:null
	 * @返回:结构化的菜单资源数组
	 */
	public function getMenu() {
		// 获取管理员角色
		// 获取该管理员的角色信息并保存session
		$roleRelModel = M ( 'admin_group' );
		$relData = $roleRelModel->field ( 'role_id' )->where ( 'admin_id=' . "'" . $this->adminId . "'" )->select ();
		
		$menuModel = M ( 'admin_menu' );
		$mainMenuData = $menuModel->query ( "select * from yybg_admin_menu menu where menu.pid is null and menu.id in (select res_id from yybg_auth auth where auth.role_id = '" . $relData [0] ['role_id'] . "' and auth_res_type = '00A')  order by PID ASC , menu.sort desc" );
		
		for($i = 0; $i < count ( $mainMenuData ); $i ++) {
			if ($mainMenuData [$i] ['URI'] == "" || $mainMenuData [$i] ['URI'] == null) {
				$mainMenuData [$i] ['subMenu'] = $menuModel->query ( "select * from yybg_admin_menu menu where menu.pid = '" . $mainMenuData [$i] ['id'] . "' and menu.id in (select res_id from yybg_auth auth where auth.role_id = '" . $relData [0] ['role_id'] . "' and auth_res_type = '00A') order by PID ASC , menu.sort desc" );
			} else
				continue;
		}
		return $mainMenuData;
	}
	
	/**
	 * 用途:根据菜单ID，获取菜单父、子链
	 * @时间: 2015年12月3日 下午2:30:04
	 * @作者: yaoyuan
	 * @参数:被查询菜单ID
	 * @返回:
	 */
	public function getMenuList($m_id) {
		$menuModel = M ( "admin_menu" );
		$retData;
		$curMenuData = $menuModel->where ( "id='" . $m_id . "'" )->find ();
		if ($curMenuData ['pid'] != "" || $curMenuData ['pid'] != null) {
			$pMenuData = $menuModel->where ( "id='" . $curMenuData ['pid'] . "'" )->find ();
			$retData [0] = $pMenuData ['menu_name'];
			$retData [1] = $curMenuData ['menu_name'];
		} else {
			$retData [0] = $curMenuData ['menu_name'];
		}
		
		return $retData;
	}
}

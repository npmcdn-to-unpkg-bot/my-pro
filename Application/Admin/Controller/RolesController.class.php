<?php

/**
 *
 *文件名:RolesController.class.php
 * ==============================================
 *文件用途
 *
 *
 * ==============================================
 * @添加时间: 2015年12月3日 上午10:48:53
 * @作者: yaoyuan
 * @版本：
 */
namespace Admin\Controller;

use Admin\Common\CommonController;
use Think\Page;
use Think\Exception;
use Common\Util\UUID;
use Admin\Common\CommonAuth;
use Think\Model;

/**
 * *类注释
 * *用途：
 * *@作者：yaoyuan
 * *@时间：2015年12月3日 上午10:55:14
 */
class RolesController extends CommonController {
	
	// 定义数据库操作对象
	private $model;
	
	/**
	 * 用途:子类构造函数
	 * @时间: 2015年12月15日 上午10:57:53
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function __construct() {
		// 执行父类构造函数
		parent::__construct ();
		// 赋值数据库操作对象
		$this->model = M ( 'role' );
	}
	
	/**
	 * 用途:加载角色管理添加Form界面
	 * @时间: 2015年12月4日 下午4:10:10
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function add() {
		try {
			// 无POST参数传入，进入展示界面
			if (0 === count ( I ( 'post.' ) )) {
				$assignData ['PAGE_FROM'] = "Add";
				
				$this->assign ( $assignData );
				$this->display ();
			}  // 否则进入增加数据模式
else {
				$data ['ID'] = UUID::getUUID ();
				
				$data ['ROLE_NAME'] = I ( 'ROLE_NAME' );
				$data ['ROLE_TYPE'] = I ( 'ROLE_TYPE' );
				
				$data ['CREATE_TIME'] = date ( 'Y-m-d h:i:s', time () );
				$data ['STATE'] = '00A';
				
				if ($this->model->add ( $data )) {
					$this->success ( "添加成功", __ROOT__ . "/" . CONTROLLER_NAME . "/show" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
				}
			}
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage () );
		}
	}
	
	/**
	 * 用途:修改管理员
	 * @时间: 2015年12月9日 上午11:42:59
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function modify() {
		try {
			// 若有get.id参数传入，则载入默认数据并展示界面
			if (null != I ( 'get.id' ) || "" != I ( 'get.id' )) {
				$data = $this->model->where ( "ID='" . I ( 'get.id' ) . "'" )->select ();
				if (0 == count ( $data ))
					throw new Exception ( "传入参数有误" );
				$assignData ['data'] = $data;
				$assignData ['PAGE_FROM'] = "Add";
				$this->assign ( $assignData );
				$this->display ();
			}  // 若有post.id参数传入，则执行修改
else if (null != I ( 'post.id' ) || "" != I ( 'post.id' )) {
				$data ['ID'] = I ( 'id' );
				$data ['ROLE_NAME'] = I ( 'ROLE_NAME' );
				$data ['ROLE_TYPE'] = I ( 'ROLE_TYPE' );
				if (null === $this->model->save ( $data ))
					throw new Exception ( "保存失败" );
				else
					$this->success ( "修改成功", __ROOT__ . "/" . CONTROLLER_NAME . "/show/m_id/" . I ( 'm_id' ) . "/p_id/" . I ( 'p_id' ), 1 );
			}
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage (), __ROOT__ . "/" . CONTROLLER_NAME . "/menulist/m_id/" . I ( 'm_id' ) . "/p_id/" . I ( 'p_id' ) );
		}
	}
	
	/**
	 * 用途:加载资源List界面
	 * @时间: 2015年12月4日 下午4:09:32
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function show() {
		try {
			//获取管理员角色分组数据
			$gModel = new Model();
			$assignData ['PAGE_FROM'] = "List";
			// 查询条件-搜索或者直接显示列表
			$where = "(STATE = '00A')";
			// 拼接查询字符串
			foreach ( I ( 'get.' ) as $key => $item ) {
				if ("m_id" == $key || 'p_id' == $key || 'p' == $key || "" == trim ( $item ))
					continue;
				else
					$where .= " and " . $key . " like '%" . $item . "%'";
			}
			
			// 分页控制
			$pageInfo ['Count'] = $this->model->where ( $where )->count ();
			$page = new Page ( $pageInfo ['Count'], 10 );
			$assignData ['pageData'] = $page->show ();
			
			$assignData ['list'] = $this->model->where ( $where )->order ( 'create_time desc' )->page ( I ( 'p' ), 10 )->select ();
			foreach($assignData ['list'] as $key => $item)
			{
				$gdata = $gModel -> query("select a.name from yybg_admin_group as g left join yybg_admin as a on g.admin_id = a.id where g.role_id='" . $item['id'] . "'");
				foreach($gdata as $akey => $admin){
					if(0 == $akey)
						$assignData ['list'][$key]['admins'] = $admin['name'];
					else
						$assignData ['list'][$key]['admins'] .= ' ' . $admin['name'];
				}
				
			}
			
			$this->assign ( $assignData );
			$this->display ();
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage () );
		}
	}
	
	/**
	 * 用途:
	 * @时间: 2015年12月7日 下午4:35:44
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function delete() {
		try {
			$adminGModel = M ( 'admin_group' );
			$id = I ( 'id' );
			if ($id == "" || $id == null)
				throw new Exception ( "非法参数" );
				// 单条删除
			else if (false === strpos ( $id, "," )) {
				$data ['ID'] = I ( 'id' );
				$data ['STATE'] = '00B';
				
				// 不可删除已分配管理员的角色信息
				$groupData = $adminGModel->where ( "ROLE_ID = '" . $id . "'" )->select ();
				if (0 != count ( $groupData ))
					throw new Exception ( "该角色下已分配管理员，请移除所有管理员后再进行删除。" );
				if (null === $this->model->save ( $data ))
					throw new Exception ( "删除失败" );
				else
					$this->success ( "删除成功", __ROOT__ . "/" . CONTROLLER_NAME . "/show" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
			}  // 批量删除
			else {
				$ids = explode ( ',', $id );
				foreach ( $ids as $key => $item ) {
					$groupData = $adminGModel->where ( "ROLE_ID = '" . $item . "'" )->select ();
					if (0 == $key)
						$idStr .= "'" . $item . "'";
						// 不可删除已分配管理员的角色信息
					else if (0 != count ( $groupData ))
						continue;
					else
						$idStr .= "," . "'" . $item . "'";
				}
				if (FALSE === $this->model->where ( "ID IN (" . $idStr . ")" )->setField ( "STATE", "00B" ))
					throw new Exception ( "删除失败！" );
				else
					$this->success ( "删除成功", __ROOT__ . "/" . CONTROLLER_NAME . "/show" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
			}
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage (), __ROOT__ . "/" . CONTROLLER_NAME . "/show/m_id/" . I ( 'm_id' ) . "/p_id/" . I ( "p_id" ), 5 );
		}
	}
	
	/**
	 * 用途:角色名称唯一性校验AJAX后台方法
	 * @时间: 2015年12月11日 上午11:54:56
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function roleUniqeCheck() {
		try {
			$data = $this->model->where ( "ROLE_NAME='" . I ( 'ROLE_NAME' ) . "' and STATE = '00A'" )->find ();
			if (NULL == $data)
				$return ['result'] = TRUE;
			else
				$return ['result'] = FALSE;
			
			$this->ajaxReturn ( $return, 'json' );
		} catch ( Exception $e ) {
		}
	}
	
	/**
	 * 用途:展示授权并执行授权操作
	 * @时间: 2015年12月21日 下午3:37:50
	 * @作者: yaoyuan
	 * @参数:role_id:角色id MenuRecAuth
	 * @返回:
	 */
	public function auth() {
		try {
			
			$authModel = M ( "auth" );
			if (NULL == I ( 'MenuRecAuth' )) {
				// 获取角色id
				$roleId = I ( 'role_id' );
				if (NULL == $roleId || "" == $roleId)
					throw new Exception ( "非法参数" );
				$comAuth = new CommonAuth ();
				
				$assignData ['PAGE_FROM'] = "List";
				
				// 获取可授权的资源
				$menuModel = M ( "admin_menu" );
				$menuData = $menuModel->where ( "STATE = '00A' and PID is NULL" )->select ();
				
				foreach ( $menuData as $key => $item ) {
					if ($comAuth->isMenuChecked ( $item ['id'], $roleId ))
						$menuData [$key] ['checked'] = 'checked';
					$subMenu = $menuModel->where ( "STATE = '00A' and PID ='" . $item ['id'] . "'" )->select ();
					if (0 == count ( $subMenu ))
						continue;
					
					foreach ( $subMenu as $subKey => $subItem ) {
						if ($comAuth->isMenuChecked ( $subItem ['id'], $roleId )) {
							$subMenu [$subKey] ['checked'] = 'checked';
						}
					}
					$menuData [$key] ['submenu'] = $subMenu;
				}
				$assignData ['menu'] = $menuData;
				$this->assign ( $assignData );
				$this->display ();
			} else {
				
				// 清空授权表
				if (false === $this -> model ->execute("delete  from yybg_auth where ROLE_ID='". I ( 'role_id' ) ."'"))
					throw new Exception ( "清空表失败" );
				else {
					foreach ( I ( 'MenuRecAuth' ) as $item ) {
						$data ['ID'] = UUID::getUUID ();
						$data ['ROLE_ID'] = I ( 'role_id' );
						$data ['RES_ID'] = $item;
						$data ['AUTH_RES_TYPE'] = "00A";
						$data ['CREATE_TIME'] = date ( 'Y-m-d h:i:s', time () );
						if (false === $authModel->add ( $data ))
							throw new Exception ( "授权失败" );
					}
					$this->success ( "授权成功", __ROOT__ . "/" . CONTROLLER_NAME . "/show" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
				}
			}
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage (), __ROOT__ . "/" . CONTROLLER_NAME . "/show/m_id/" . I ( 'm_id' ) . "/p_id/" . I ( "p_id" ), 5 );
		}
	}
}
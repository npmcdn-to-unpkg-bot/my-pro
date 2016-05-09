<?php

/**
 *
 *文件名:IndexController.class.php
 * ==============================================
 *文件用途
 *
 *
 * ==============================================
 * @添加时间: 2015年11月26日 下午8:58:18
 * @作者: yaoyuan
 * @版本：
 */

namespace Admin\Controller;

use Think\Controller;
use Common\Util\UUID;
use Think\Exception;
use Admin\Common\CommonController;
use Admin\Common\CommonMenu;
use Think\Model;
/**
 * *用途：
 * *@作者：yaoyuan
 * *@时间：2015年11月26日 下午8:59:20
 */
class IndexController extends CommonController {
	
	public function index() {
		
		$assignData ['PAGE_FROM'] = "Index";
		
		$this->assign ( $assignData);
		
		$this->display ();
	}
	
	public function login() {
		$this->display ();
	}
	
	/**
	 * 用途:
	 * @时间: 2015年11月26日 下午8:58:47
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function adminValidate() {
		try {
			// 从数据库中获取登录管理员的帐号及密码以验证
			$adminModel = M ( 'admin' );
			$option ['ACCOUNT'] = I ( 'post.account' );
			$option ['PSW'] = md5 ( I ( 'post.password' ) );
			$option ['STATE'] = '00A';
			$result = $adminModel->where ( $option )->select ();
			
			// 判断验证是否通过
			if (count ( $result ) == 0) {
				$this->error ( "用户名或密码错误" );
			} else {
				// 验证通过
				session ( 'adminName', $result [0] ['name'] );
				session ( 'adminKey', $result [0] ['id'] );
				session ( 'adminType', $result [0] ['admin_type'] );
				$this->success ( "登录成功" , "index" , 2 );
				$data['ID'] = $result [0] ['id'];
				$data['LAST_LOGIN'] = date ( 'Y-m-d h:i:s', time () );
				$adminModel -> save($data);
			}
			
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage (), '', 5 );
		}
	}
	
	/**
	 * 用途:管理员退出
	 * @时间: 2015年11月26日 下午9:38:18
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function logout() {
		session('[destroy]');
		$this ->success("退出成功" , 'login');
	}
}
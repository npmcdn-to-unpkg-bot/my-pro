<?php

/**
 *
 *文件名:ResourcesController.class.php
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
use Admin\Common\CommonMenu;
use Admin\Model;
use Think\Page;
use Think\Exception;
use Common\Util\UUID;

/**
 * *类注释
 * *用途：
 * *@作者：yaoyuan
 * *@时间：2015年12月3日 上午10:55:14
 */
class ResourcesController extends CommonController {
	/**
	 * 用途:加载资源添加Form界面
	 * @时间: 2015年12月4日 下午4:10:10
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function menuAdd() {
		try {
			$model = D ( 'admin_menu' );
			// 无POST参数传入，进入展示界面
			if (0 === count ( I ( 'post.' ) )) {
				$assignData ['mainMenu'] = $model->where ( "pid is null and state = '00A'" )->select ();
				$assignData ['PAGE_FROM'] = "Add";
				
				$this->assign ( $assignData );
				$this->display ();
			} 			// 否则进入增加数据模式
			else {
				$data ['ID'] = UUID::getUUID ();
				
				$data ['SORT'] = I( 'sort' );
				$data ['MENU_ICON'] = (NULL == I( 'icon' ) || "" == I('icon'))?NULL:I('icon');
				$data ['STATE'] = "00A";
				$data ['URI'] = I( 'uri' );
				$data ['CREATE_TIME'] = date ( 'Y-m-d H:i:s', time () );
				$data ['MENU_NAME'] = I( 'menu_name' );
				if ("none" == I ( 'pid' )) {
					$data ['PID'] = NULL;
					$data ['PNAME'] = NULL;
				} else {
					$data ['PID'] = explode ( "/", I ( 'pid' ) )[0];
					$data ['PNAME'] = explode ( "/", I ( 'pid' ) )[1];
				}
				if ($model->add ( $data )) {
					$this->success ( "添加成功", __ROOT__."/".CONTROLLER_NAME."/menulist" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
				}
			}
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage () );
		}
	}
	
	/**
	* 用途:修改菜单
	* @时间: 2015年12月9日 上午11:42:59
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function menuModify(){
		try
		{
			$model = M('admin_menu');
			//若有get.id参数传入，则载入默认数据并展示界面
			if(null != I('get.id') || "" != I('get.id')){
				$data = $model -> where("ID='".I('get.id')."'") -> select();
				if(0 == count($data))
					throw new Exception("传入参数有误");
				$assignData['data'] = $data;
				$assignData ['PAGE_FROM'] = "Add";
				$assignData ['mainMenu'] = $model->where ( "pid is null and state = '00A' and id <>'".I('get.id')."'")->select ();
				$this -> assign($assignData);
				$this-> display();
			}
			//若有post.id参数传入，则执行修改
			else if(null != I('post.id') || "" != I('post.id')){
				$data['ID'] = I('id');
				$data ['SORT'] = I ( 'sort' );
				$data ['MENU_ICON'] = (NULL == I ( 'icon' ) || "" == I('icon'))?NULL:I('icon');
				$data ['URI'] = I ( 'uri' );
				$data ['MENU_NAME'] = I ( 'menu_name' );
				
				if ("none" == I ( 'pid' )) {
					$data ['PID'] = NULL;
					$data ['PNAME'] = NULL;
				} else {
					$data ['PID'] = explode ( "/", I ( 'pid' ) )[0];
					$data ['PNAME'] = explode ( "/", I ( 'pid' ) )[1];
				}
				if (null === $model->save ( $data ))
					throw new Exception ( "保存失败" );
				else 
					$this -> success("修改成功" ,__ROOT__."/".CONTROLLER_NAME."/menulist/m_id/".I('m_id')."/p_id/".I('p_id') ,1);
			}
		}
		catch(Exception $e)
		{
			$this -> error($e->getMessage() , __ROOT__."/".CONTROLLER_NAME."/menulist/m_id/".I('m_id')."/p_id/".I('p_id'));
		}
	}
	/**
	 * 用途:加载资源List界面
	 * @时间: 2015年12月4日 下午4:09:32
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function menuList() {
		try {
			$assignData ['PAGE_FROM'] = "List";
			//查询条件-搜索或者直接显示列表
			$where = "(STATE = '00A')";
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
			
			// 分页控制
			$model = M ( "admin_menu" );
			
			$pageInfo ['Count'] = $model->where ( $where)->count ();
			$page = new Page ( $pageInfo ['Count'], 10 );
			$assignData ['pageData'] = $page->show ();
			$assignData ['list'] = $model->where ( $where )->order ( 'pid,sort desc' )->page ( I ( 'p' ), 10 )->select ();
			$this->assign ( $assignData );
			$this->display ();
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage () );
		}
	}
	
	/**
	 * 用途:列表页面调用ajax修改排序
	 * @时间: 2015年12月4日 下午2:55:50
	 * @作者: yaoyuan
	 * @参数:id:被修改数据id，sort:新sort
	 * @返回:ajaxReturn:result:是否成功，msg:失败原因
	 */
	public function modifySort() {
		$model = M ( "admin_menu" ); // new Model();
		
		$data ['ID'] = I ( "id" );
		$data ['SORT'] = I ( "sort" );
		
		try {
			if (null === $model->save ( $data ))
				throw new Exception ( "保存失败" );
			else {
				$return ['result'] = 'success';
				$return ['msg'] = '保存成功';
			}
		} catch ( Exception $e ) {
			$return ['result'] = 'error';
			$return ['msg'] = $e->getMessage ();
		} finally {
			$this->ajaxReturn ( $return, 'json' );
		}
	}
	
	/**
	 * 用途:
	 * @时间: 2015年12月7日 下午4:35:44
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function menuDelete() {
		try {
			$id = I ( 'id' );
			if ($id == "" || $id == null)
				throw new Exception ( "非法参数" );
			else if(false === strpos($id, ",")) {
				$model = M ( "admin_menu" );
				$menuData = $model->where ( "PID='" . $id . "'" )->select ();
				if (count ( $menuData ) == 0) {
					if(false !== $model -> where("ID='".$id."'") -> delete())
					$this -> success("删除成功", __ROOT__."/".CONTROLLER_NAME."/menulist"."/m_id/".I("m_id")."/p_id/".I("p_id") , 1);
					else
					throw new Exception("删除失败");
				} else {
					throw new Exception("删除失败，该菜单具有子菜单，请移除所有子菜单后删除！");
				}
			}
			else{
				$ids = explode(',', $id);
				$deleteState = 1;
				foreach($ids as $item ){
					$model = M ( "admin_menu" );
					$menuData = $model->where ( "PID='" . $item . "'" )->select ();
					if (count ( $menuData ) == 0) {
						if(false !== $model -> where("ID='".$item."'") -> delete())
							continue;
						else{
							$deleteState = 0;
							continue;
						}
					} else {
						$deleteState = 0;
						continue;
					}
				}
				if(1 == $deleteState)
					$this -> success("删除所有菜单成功", __ROOT__."/".CONTROLLER_NAME."/menulist"."/m_id/".I("m_id")."/p_id/".I("p_id") , 1);
				else
					throw new Exception("部分菜单删除失败，可能该菜单具有子菜单，请移除其所有子菜单后删除！");
			}
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage () ,__ROOT__."/".CONTROLLER_NAME."/menulist/m_id/" . I('m_id') . "/p_id/" . I("p_id") , 5);
		}
	}
}
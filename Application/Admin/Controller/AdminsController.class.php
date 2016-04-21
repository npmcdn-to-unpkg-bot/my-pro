<?php

/**
 *
 *文件名:AdminsController.class.php
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

/**
 * *类注释
 * *用途：
 * *@作者：yaoyuan
 * *@时间：2015年12月3日 上午10:55:14
 */
class AdminsController extends CommonController {
	
	//定义数据库操作对象
	private $model;
	
	/**
	* 用途:子类构造函数
	* @时间: 2015年12月15日 上午10:57:53
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public  function __construct(){
		//执行父类构造函数
		parent::__construct();
		//赋值数据库操作对象
		$this -> model = M('admin');
	}
	
	
	/**
	 * 用途:加载管理员管理添加Form界面
	 * @时间: 2015年12月4日 下午4:10:10
	 * @作者: yaoyuan
	 * @参数:
	 * @返回:
	 */
	public function add() {
		try {
			
			// 无POST参数传入，进入展示界面
			if (0 === count ( I ( 'post.' ) )) {
				$rModel = M('role');
				$assignData ['PAGE_FROM'] = "Add";
				//获取角色列表
				$assignData['rData'] = $rModel -> where("STATE = '00A'") -> select();
				$this->assign ( $assignData );
				$this->display ();
			} 			// 否则进入增加数据模式
			else {
				$gModel = M('admin_group');
				$data ['ID'] = UUID::getUUID ();
				
				$data ['NAME'] = I( 'NAME' );
				$data ['FACE_FILE_NAME'] = NULL;
				$data ['TEL_PHONE'] = I( 'TEL_PHONE' );
				$data ['EMAIL'] = I( 'EMAIL' );
				$data ['ACCOUNT'] = I( 'ACCOUNT' );

				$data ['PSW'] = md5(C('DEFAULT_PSW'));
				$data ['ACCOUNT'] = I( 'ACCOUNT' );
				$data ['ADMIN_TYPE'] = I( 'ADMIN_TYPE' );
				$data ['SEX'] = I( 'SEX' );
				
				$data ['CREATE_TIME'] = date ( 'Y-m-d h:i:s', time () );
				$data ['LAST_LOGTIN'] = date ( 'Y-m-d h:i:s', time () );
				$data['STATE'] = '00A';
				
				$gdata['ID'] = UUID::getUUID();
				$gdata['ADMIN_ID'] = $data['ID'];
				$gdata['ROLE_ID'] = ("NULL" == I('ROLE_ID'))?NULL:I('ROLE_ID');
				$gdata ['CREATE_TIME'] = date ( 'Y-m-d h:i:s', time () );
				
				if ($this -> model->add ( $data ) && $gModel -> add($gdata)) {
					$this->success ( "添加成功", __ROOT__."/".CONTROLLER_NAME."/show" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
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
	public function modify(){
		try
		{
			$gModel = M('admin_group');
			//检查传入ID的有效性
			$_data = $this -> model -> where("ID='".I('id')."'") -> select();
			if(0 == count($_data))
				throw new Exception("传入参数有误");
			
			//若有get.id参数传入，则载入默认数据并展示界面
			if(null != I('get.id') || "" != I('get.id')){
				$assignData['data'] = $_data;
				$assignData ['PAGE_FROM'] = "Add";
				
				$rModel = M('role');
				$assignData['rData'] = $rModel -> where("STATE = '00A'") -> select();
				$gData = $gModel -> where("ADMIN_ID = '" . I('get.id') . "'") -> find(); 
				$assignData['rid'] = $gData['role_id'];
				$this -> assign($assignData);
				$this-> display();
			}
			//若有post.id参数传入，则执行修改
			else if(null != I('post.id') || "" != I('post.id')){
				$data['ID'] = I('id');
				
				$data ['NAME'] = I( 'NAME' );
				$data ['FACE_FILE_NAME'] = NULL;
				$data ['TEL_PHONE'] = I( 'TEL_PHONE' );
				$data ['EMAIL'] = I( 'EMAIL' );
				$data ['ADMIN_TYPE'] = I( 'ADMIN_TYPE' );
				$data ['SEX'] = I( 'SEX' );
				
				if (null === $this -> model->save ( $data ))
					throw new Exception ( "保存失败" );
				else {
					$_gData = $gModel -> where("ADMIN_ID = '" . I('id'). "'") -> find();
					if("NULL" != I("ROLE_ID") && NULL != $_gData){
						$gData['ID'] = $_gData['id'];
						$gData['ADMIN_ID'] = I('id');
						$gData['ROLE_ID'] = I("ROLE_ID");
						if(NULL === $gModel -> save($gData))
							throw new Exception("更新角色信息失败");
					}
					if("NULL" != I('ROLE_ID') && NULL == $_gData){
						$gData['ID'] = UUID::getUUID();
						$gData['ADMIN_ID'] = I('id');
						$gData['ROLE_ID'] = I("ROLE_ID");
						$gData ['CREATE_TIME'] = date ( 'Y-m-d h:i:s', time () );
						if (NULL === $gModel -> add($gData)) 
							throw new Exception("添加角色信息失败");
					}
					$this->success ( "修改管理员信息成功", __ROOT__."/".CONTROLLER_NAME."/show" . "/m_id/" . I ( "m_id" ) . "/p_id/" . I ( "p_id" ), 1 );
				}
			}
		}
		catch(Exception $e)
		{
			$this -> error($e->getMessage() , __ROOT__."/".CONTROLLER_NAME."/menulist/m_id/".I('m_id')."/p_id/".I('p_id'));
		}
	}
	
	/**
	* 用途:重置密码
	* @时间: 2015年12月11日 上午11:14:31
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public  function  pswReset(){
		try {
			if(NULL == I('id') || "" == I("id"))
				throw new Exception("参数错误");
			else{
				$data['ID'] = I('id');
				$data['PSW'] = md5(C("DEFAULT_PSW"));
				if(FALSE === $this -> model -> save($data))
					throw new Exception("密码重置失败");
				else
					$this -> success("密码重置成功" ,__ROOT__."/".CONTROLLER_NAME."/show/m_id/".I('m_id')."/p_id/".I('p_id') ,1);
			}
		} catch (Exception $e) {
			$this -> error($e -> getMessage() , __ROOT__."/".CONTROLLER_NAME."/show/m_id/".I('m_id')."/p_id/".I('p_id'));
		}
	}
	
	/**
	* 用途:冻结帐号
	* @时间: 2015年12月15日 上午9:51:57
	* @作者: yaoyuan
	* @参数:需要冻结的帐号id
	* @返回:
	*/
	public function frozen(){
		try {
			$data['ID'] = I('id');
			if(NULL == $data['ID'] || "" == $data['ID'])
				throw new  Exception("非法参数");
			if(session('adminKey') == $data['ID'])
				throw new Exception("不可冻结个人帐号");
			
			$data['STATE'] = '00B';
			if(false === $this -> model ->save($data))
				throw new Exception("冻结帐号失败");
			else 
				$this -> success("冻结帐号成功");
			
		} catch (Exception $e) {
			$this -> error($e -> getMessage() , __ROOT__."/".CONTROLLER_NAME."/show/m_id/".I('m_id')."/p_id/".I('p_id'));
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
			$assignData ['PAGE_FROM'] = "List";
			//查询条件-搜索或者直接显示列表
			$where = "(STATE = '00A' or STATE = '00B')";
			//拼接查询字符串
			foreach(I('get.') as $key => $item)
			{
				if("m_id" == $key || 'p_id' == $key || 'p' == $key || "" == trim($item))
					continue;
				else
					$where .= " and " . $key . " like '%".$item."%'";
			}
			// 分页控制
			$pageInfo ['Count'] = $this -> model->where ( $where)->count ();
			$page = new Page ( $pageInfo ['Count'], 10 );
			$assignData ['pageData'] = $page->show ();
			
			$assignData ['list'] = $this -> model->where ( $where )->order ( 'create_time desc' )->page ( I ( 'p' ), 10 )->select ();
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
			$id = I ( 'id' );
			if ($id == "" || $id == null)
				throw new Exception ( "非法参数" );
			//单条删除
			else if(false === strpos($id, ",")) {
				$data['ID'] = I('id');
				$data['STATE'] = '00C';
				
				//不可删除当前管理员自身的管理员帐号
				if(session("adminKey") == $data['ID'])
					throw new Exception ( "不可删除自己的管理员帐号信息" );
				
				if(null === $this -> model->save ( $data ))
					throw new Exception ( "删除失败" );
				else 
					$this -> success("删除成功", __ROOT__."/".CONTROLLER_NAME."/show"."/m_id/".I("m_id")."/p_id/".I("p_id") , 1);
			}
			//批量删除
			else{
				$ids = explode(',', $id);
				foreach($ids as $key => $item ){
					if(0==$key)
						$idStr .= "'" . $item . "'";
					//排除当前管理员帐号，不可删除自己的管理员帐号
					else if(session("adminKey") == $item)
						continue;
					else 
						$idStr .= "," . "'" . $item . "'";
				}
				if(FALSE === $this -> model -> where("ID IN (".$idStr.")") -> setField("STATE" , "00C"))
					throw new Exception("删除失败！");
				else 
					$this -> success("删除成功", __ROOT__."/".CONTROLLER_NAME."/show"."/m_id/".I("m_id")."/p_id/".I("p_id") , 1);
			}
		} catch ( Exception $e ) {
			$this->error ( $e->getMessage () ,__ROOT__."/".CONTROLLER_NAME."/show/m_id/" . I('m_id') . "/p_id/" . I("p_id") , 5);
		}
	}
	
	/**
	* 用途:帐号唯一性校验AJAX后台方法
	* @时间: 2015年12月11日 上午11:54:56
	* @作者: yaoyuan
	* @参数:
	* @返回:
	*/
	public function accountUniqeCheck(){
		try {
			$data = $this -> model -> where("ACCOUNT='" .I('ACCOUNT'). "' and STATE = '00A'") -> find();
			if(NULL == $data)
				$return['result'] = TRUE;
			else 
				$return['result'] = FALSE;
			
			$this -> ajaxReturn($return , 'json');
		} catch (Exception $e) {
			
		}
	}
	
	/**
	* 用途:异步获取指定ID的信息，用于列表界面的详细信息展示
	* @时间: 2015年12月15日 下午3:28:31
	* @作者: yaoyuan
	* @参数:被查询的信息ID
	* @返回:JSON信息
	*/
	public function getDetail(){
		try {
			$id = I('id');
			if(NULL == $id || "" == $id)
				throw new Exception("非法参数");
			$return['data'] = $this -> model ->where("ID='". $id ."'") -> find();
			$return['result'] = 'success';
			$this -> ajaxReturn($return , 'json');
		} catch (Exception $e) {
			$return['result'] = 'false';
			$return['msg'] = $e -> getMessage() ;
			$this -> ajaxReturn($data, 'json');
		}
	}

	/**
	* 用途:管理员个人密码设置
	* @时间: 2015年12月15日 下午4:46:55
	* @作者: yaoyuan
	* @参数:用户ID、原始密码、新密码
	* @返回:
	*/
	public function setPsw(){
		try {
			if(NULL == trim(I('OLD_PSW')) || "" == trim(I('OLD_PSW')) || NULL == trim(I('NEW_PSW')) || NULL == trim(I('NEW_PSW')))
				throw new Exception("旧密码或新密码不能为空");
			$oldData = $this -> model -> where("ID='" . session('adminKey') . "'") -> find();

			if($oldData['psw'] != md5(trim(I('OLD_PSW'))))
				throw new Exception("旧密码错误");
			
			$data['ID'] = session('adminKey');
			$data['PSW'] = md5(trim(I('NEW_PSW')));
			if(FALSE === $this -> model -> save($data))
				throw new Exception("密码设置失败");
			else
				$this->success("设置成功");
		} catch (Exception $e) {
			$this  -> error($e -> getMessage());
		}
	}
}
<?php
namespace Admin\Model;
use Think\Model;

class AdminValMode extends Model{
	
	//定义自动验证
	protected $_validate = array(
			array('account' , 'require' , '请填写管理员帐号'),
			array('password' , 'require' , '请填写管理员密码')
	);
	
}
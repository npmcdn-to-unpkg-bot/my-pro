<?php
namespace Think\Template\TagLib;

use Think\Template\TagLib;

/**
*类注释
*用途：自定义标签库
*@作者：yaoyuan
*@时间：2016年5月5日 下午10:40:35
*/
class Util extends TagLib{
	
	/*
	*标签定义
	*/
	protected $tag = array(
		// 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
		"count" => array("attr" => "data" , "close" => "0")
	);
	
	/**
	* 用途:count标签解析
	* @时间: 2016年5月5日 下午10:44:14
	* @作者: yaoyuan
	* @参数:$data
	* @返回:string
	*/
	public function _count($tag) {
		$parseStr = "";
		$parseStr =  "<?php echo ".count($tag['data'])."; ?>";		
		if(!empty($parseStr)) {
			return $parseStr;
		}
		return ;
	}
}
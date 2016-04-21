<?php
/**
*
*文件名:InterController.class.php
* ==============================================
*文件用途
*
*
* ==============================================
* @添加时间: 2016年1月11日 上午8:47:07
* @作者: yaoyuan
* @版本：
*/
namespace Admin\Controller;

use Admin\Common\CommonController;
use Org\Net;
use Org\Net\Http;

class InterController extends CommonController{
	public function test(){
		
		$header = array("Content-type:text/html; charset=utf-8","apikey:3073411f13b1ad380dec031e20859a7b");
		//获取可团购分类
		if("categories" == I('type')){
			$data = Http::getResponse("http://apis.baidu.com/baidunuomi/openapi/categories" , "" , 'GET' , $header);
			$result = json_decode($data, true);
		}
		//获取城市列表
		if("city" == I('type')){

			$data = Http::getResponse("http://apis.baidu.com/baidunuomi/openapi/cities" , "" , 'GET' , $header);
			$result = json_decode($data, true);
			
		}
		//根据城市ID获取该城市行政区划
		if('districts' == I('type')){
			
			$data = Http::getResponse("http://apis.baidu.com/baidunuomi/openapi/districts" , array("city_id"=>"3000010000") , 'GET' , $header);
			$result = json_decode($data, true);
		}
		//根据条件获取相应的团单
		if('searchdeals' == I('type')){
			//城市ID
			$params['city_id'] = "3000010000";
			//分类
			$params['cat_ids'] = "323";
			//子分类
			$params['subcat_ids'] = "345";
			//行政区划
// 			$params['district_ids'] = "";
			//商圈
// 			$params['bizarea_ids'] = "";
			//用户坐标
			$params['location'] = "103.889802,36.060798";
			//关键词
			$params['keyword'] = "太平洋";
			//搜索位置半径
// 			$params['radius'] = 0;
			//排序方式 0:综合排序 1：价格低优先， 2：价格高优先， 3：折扣高优先， 4：销量高优先， 5：用户坐标距离近优先， 6：最新发布优先,8:用户评分高优先
// 			$params['sort'] = "";
			//分页页码
// 			$params['page'] = "";
			//分页数量 最小值1，最大值50，如不传入默认为10
// 			$params['page_size'] = "";
			//是否筛选出免预约,否: 默认不传 0为不筛选 1为筛选出支持免预约的团单
// 			$params['is_reservation_required'] = "";
			
			$data = Http::getResponse("http://apis.baidu.com/baidunuomi/openapi/searchdeals" , $params , 'GET' , $header);
			$result = json_decode($data, true);
			
		}
		
		//根据城市ID获取该城市行政区划
		if('districts' == I('kuaidi')){
			$header = array("Content-type:text/html; charset=utf-8","apikey:3073411f13b1ad380dec031e20859a7b");
			$data = Http::getResponse("http://apis.baidu.com/baidunuomi/openapi/districts" , array("city_id"=>"3000010000") , 'GET' , $header);
			$result = json_decode($data, true);
		}
		
		$this -> assign("ret" , $result);
		$this -> display();
	}
}
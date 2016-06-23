<?php
/**
 *
 *文件名:AmapUtil.class.php
 * ==============================================
 *文件用途
 * 定义高德工具类
 *
 * ==============================================
 * @添加时间: 2016年5月31日 上午9:01:29
 * @作者: yaoyuan
 * @版本：
 */
namespace Common\Util;

use Think\Exception;
use Org\Net\Http;
use Think\Log;
/**
*类注释
*用途：高德地图帮助类
*@作者：yaoyuan
*@时间：2016年5月31日 上午9:01:19}
*/
class AmapUtil extends BaseUtil{
    
    /**
    *高德地图web api key
    *
    */
    private $amapWebApiKey = "";
    
    /**
    * 用途:构造方法
    * @时间:  2016年5月31日 上午9:12:42
    * @作者: yaoyuan
    * @参数:
    * @返回:
    */
    public function __construct() {
        try{
            parent::_initialize();
        }
        catch(Exception $ex){
            $this -> debug($ex -> getMessage(), 'Exception');
        }
    }
    
    /**
    * 用途:通过经纬度获取结构化城市信息
    * @时间:  2016年5月31日 上午10:32:48
    * @作者: yaoyuan
    * @参数:@longtitude 经度   @latitude 纬度
    * @返回:
    * false 调用失败
    * cityName 反查出来的城市信息
    * err 返回的调用失败信息  
    */
    public function getCityByLongAndLat($longtitude , $latitude ,&$err) {
        try{
            $err = "";
            if(empty($longtitude) || empty($latitude)){
                $err = '经纬度不可为空';
                return false;
            }
            
            //参数列表
            $param['key'] = C('AMAP_CONFIG')['AMAP_WEB_API_KEY'];
            $param['location'] = number_format($longtitude ,6) . ',' . number_format($latitude ,6);
            $param['radius'] = 10;
            //组织调用地址
            $callUrl = $this->combineUri( C('AMAP_CONFIG')['AMAP_WEB_API_URL']['REGEO'], $param);
            //调用
            $header = array("Content-type:text/html; charset=utf-8");
            $response = Http::getResponse($callUrl,'', 'GET' , $header);
            
            $result = json_decode($response ,true);
            if(!$result['status']){
                $err = $result['infocode'].":".$result['info'];
                return false;
            }
            if('中国' !== $result['regeocode']['addressComponent']['country']){
                $err = "未定位到国内城市";
                return false;
            }
            Log::write("高德地图返回信息：" . json_encode($result) , 'INFO');
            return $result['regeocode']['addressComponent']['city'];
        }
        catch(Exception $ex){
            $this -> debug($ex -> getMessage(), 'Exception');
        }
    }
    
    
}
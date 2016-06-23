<?php
/**
 *
 *文件名:BaseUtil.class.php
 * ==============================================
 *文件用途
 * 定义工具类基类
 *可以进行debug输出
 * ==============================================
 * @添加时间: 2016年5月31日 上午9:02:46
 * @作者: yaoyuan
 * @版本：
 */
namespace Common\Util;

use Think\Exception;
use PhpConsole;
use Think\Log;

/**
*类注释
*用途：工具类基类定义
*@作者：yaoyuan
*@时间：2016年5月31日 上午9:06:07}
*/
class BaseUtil{
    //控制调试开关
    private $debug = true;
    
    //Phpconsole调试句柄
    protected  $dh;
    
    public function _initialize() {
        //设置PhpConsole调试句柄
        if($this -> debug){
            if(!PhpConsole\Handler::getInstance() ->isStarted()){
                $this -> dh = PhpConsole\Handler::getInstance();
                $this -> dh -> start();
            }else
                $this -> dh = PhpConsole\Handler::getInstance();
        }
    }
    
    /**
     * 用途:调试方法
     * @时间: 2016年4月23日 上午10:18:41
     * @作者: yaoyuan
     * @参数:msg:调试信息    id:调试id
     * @返回:
     */
    public function debug($msg , $id){
        try {
            if($this -> debug)
                $this -> dh -> debug($msg , $id);
        }
        catch(Exception $e){
            	
        }
    }
    
    /**
     * 用途:去除收尾空格并过滤特殊字符
     * @时间: 2016年4月27日 上午10:31:39
     * @作者: yaoyuan
     * @参数:string
     * @返回:string
     */
    public function trimAndHtmlSpecialChars($string){
        try{
            return trim(htmlspecialchars($string));
        }
        catch(Exception $ex){
            Log::write($ex->getMessage() , 'EMERG');
        }
    }    
    /**
    * 用途:方法
    * @时间:  2016年5月31日 上午11:32:10
    * @作者: yaoyuan
    * @参数:uri 接口地址  param 参数列表
    * @返回:
    */
    public function combineUri($uri , $param) {
        try{
            
            if(empty($uri) || empty($param)) return false;
            $targetUri = $uri;
            foreach($param as $key => $value){
                $targetUri .= $key."=".$value."&";
            }
            return substr($targetUri, 0,strlen($targetUri)-1);
        }
        catch(Exception $ex){
            $this -> debug($ex -> getMessage(), 'Exception');
        }
    }
}
<?php
/**
 *
 *文件名:Util.class.php
 * ==============================================
 *文件用途
 * 通用工具类文件
 *
 * ==============================================
 * @添加时间: 2016年6月14日 上午11:12:57
 * @作者: yaoyuan
 * @版本：
 */
namespace Common\Util;

use Think\Exception;
use Think\Log;
class Util{
    
    /**
    * 用途:生成6为随机数字
    * @时间:  2016年6月14日 上午10:36:03
    * @作者: yaoyuan
    * @参数:
    * @返回:生成的随机字符串
    */
    static function generateCode($len=6,$format='NUMBER') {
        try{
            switch($format) {
                case 'ALL':
                    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; break;
                case 'CHAR':
                    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~'; break;
                case 'NUMBER':
                    $chars='0123456789'; break;
                default :
                    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
                    break;
            }
            mt_srand((double)microtime()*1000000*getmypid());
            $str="";
            while(strlen($str)<$len)
                $str.=substr($chars,(mt_rand()%strlen($chars)),1);
            return $str;
        }
        catch(Exception $ex){
            Log::write($ex->getMessage() , 'ERROR');
        }
    }
    
    /**
    * 用途:检查手机号码合法性
    * @时间:  2016年6月14日 下午4:20:24
    * @作者: yaoyuan
    * @参数:phone 手机号码
    * @返回:true 合法 false 不合法
    */
    static  function checkPhoneNumber($phone) {
        try{
            //目标手机号码正则验证
            return  preg_match("/^1[34578]\d{9}$/", $phone);
        }
        catch(Exception $ex){
            Log::write($ex->getMessage() , 'ERROR');
        }
    }
}
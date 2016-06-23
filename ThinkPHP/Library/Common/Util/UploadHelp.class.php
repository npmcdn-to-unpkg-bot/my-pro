<?php
/**
 *
 *文件名:UploadHelp.class.php
 * ==============================================
 *文件用途
 *文件上传类文件定义
 *
 * ==============================================
 * @添加时间: 2016年5月30日 下午8:41:38
 * @作者: yaoyuan
 * @版本：
 */
namespace Common\Util;

use Think\Exception;
use Think\Log;
use Think\Upload;

/**
*类注释
*用途：文件上传类定义
*@作者：yaoyuan
*@时间：2016年5月30日 下午8:43:47}
*/
class UploadHelp extends \Think\Upload{
    
    /**
     * 默认上传配置
     * @var array
     */
    protected  $config = array(
            'mimes'         =>  array(), //允许上传的文件MiMe类型
            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array(), //允许上传的文件后缀
            'autoSub'       =>  true, //自动子目录保存文件
            'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'      =>  './Uploads/', //保存根路径
            'savePath'      =>  '', //保存路径
            'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
            'replace'       =>  false, //存在同名是否覆盖
            'hash'          =>  true, //是否生成hash编码
            'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
            'driver'        =>  '', // 文件上传驱动
            'driverConfig'  =>  array(), // 上传驱动配置
            'middleThumb'   =>  false,//是否生成中图缩略图 
            'minThumb'      =>  false,//是否生成小图缩略图
    );
    
    /**
    * 默认中等缩略图比率
    * 
    */
    private $midThumbRatio = 0.7;
    
    /**
    * 默认小图缩略图比率
    *
    */
    private $minThumbRatio = 0.5;
    
    /**
    * 用途:构造方法
    * @时间:  2016年5月30日 下午8:49:26
    * @作者: yaoyuan
    * @参数:
    * @返回:
    */
    public function __construct($config = array()) {
        try{
            parent::__construct($config);
            
        }
        catch(Exception $ex){
            Log::write("EXCEPTION:" . $ex -> getMessage(), 'ERROR');
        }
    }
    
    /**
    * 用途:方法
    * @时间:  2016年5月30日 下午8:50:52
    * @作者: yaoyuan
    * @参数:$key 指定的文件域ID
    * @返回 false 文件上传失败  $info 上传文件的信息
    */
    public function singleImageUpload($key , &$err) {
        try{
            //上传文件
            $info = $this->upload();

            if(!info){
                $err = $this->getError();
                return false;
            }
            else{
                //生成中、小缩略图
                if($this->__get('middleThumb') || $this->__get('minThumb')){
                    //图像操作类
                    $image = new \Think\Image();//打开已经上传的文件
                    $image -> open($this->__get('rootPath') . $this->__get('savePath') . $info[$key]['savename']);
                    //生成中缩略图
                    if($this->__get('middleThumb'))
                        $image -> thumb($image -> width() * $this->midThumbRatio, $image -> height() * $this->midThumbRatio , 1) ->save($this->__get('rootPath') . $this->__get('savePath') . 'mid_' . $info[$key]['savename']);
                    //生成小缩略图
                    if($this->__get('minThumb'))
                        $image -> thumb($image -> width() * $this->minThumbRatio, $image -> height() * $this->minThumbRatio , 1) ->save($this->__get('rootPath') . $this->__get('savePath') . 'min_' . $info[$key]['savename']);
                }
            }
            return $info;
        }
        catch(Exception $ex){
            Log::write("EXCEPTION:" . $ex -> getMessage(), 'ERROR');
        }
    }
}
<?php

/**
 *
 *文件名:CityController.class.php
 * ==============================================
 *文件用途
 *城市信息管理
 *
 * ==============================================
 * @添加时间: 2016年5月17日 下午11:15:11
 * @作者: yaoyuan
 * @版本：
 */
namespace Admin\Controller;

use Admin\Common\CommonController;
use Admin\Model;
use Think\Exception;

class CityController extends CommonController {
    
    /*
    *城市管理模型
    */
    private $cityModel;
    
    /**
    * 用途:构造函数方法
    * @时间:  2016年5月17日 下午11:44:33
    * @作者: yaoyuan
    * @参数:
    * @返回:
    */
    function __construction() {
        try{
            parent::__construction();
            //实例化城市管理模型
            $this->cityModel = new \Admin\Model\CityModel();
        }
        catch(Exception $ex){
            $this -> debug($ex -> getMessage(), 'Exception');
        }
    }
    
    /**
    * 用途:列表展示方法
    * @时间:  2016年5月17日 下午11:48:23
    * @作者: yaoyuan
    * @参数:
    * @返回:
    */
    function ViewList() {
        try{
            $assignData['FROM'] = 'List';
            
            $this->assign($assignData);
            $this->display();
        }
        catch(Exception $ex){
            $this -> debug($ex -> getMessage(), 'Exception');
        }
    }
    
    /**
    * 用途:新增城市方法
    * @时间:  2016年5月17日 下午11:56:50
    * @作者: yaoyuan
    * @参数:
    * @返回:
    */
    function ViewAdd() {
        try{
            $assignData['FROM'] = 'Add';
            
            $this->assign($assignData);
            $this->display();
        }
        catch(Exception $ex){
            $this -> debug($ex -> getMessage(), 'Exception');
        }
    }
    
    /**
    * 用途:数据库中插入城市信息方法
    * @时间:  2016年5月18日 上午12:00:51
    * @作者: yaoyuan
    * @参数:
    * @返回:
    */
    function Add() {
        try{
            
        }
        catch(Exception $ex){
            $this -> debug($ex -> getMessage(), 'Exception');
        }
    }
}
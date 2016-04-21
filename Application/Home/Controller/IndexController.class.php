<?php
namespace Home\Controller;
use Think\Controller;
use Common\Util\Http;

class IndexController extends Controller {
    public function index($param){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
//     	$Data = M('think_data');
//     	$result = $Data -> find(1);
//     	$testObj = new test();
    	$this -> assign('param' ,$param);
    	
    	//$this -> display();
//     	$this -> assign("result" , $result);
//     	//$this -> assign("FILE" , __URL__);
//     	echo  I('test' , 0 , 'email');
    	$this -> display();
    }
    
    public function test(){
//     	"sn": null,
//     	"sipwd": "yaoyuan860710",
//     	"aac006": "6201211986071",
//     	"account": "yy86710",
//     	"code": "731328",
//     	"email": "yy86710@126.com",
//     	"idno": "620121198607100032",
//     	"sino": "1000785163",
//     	"name": "姚远",
//     	"password": "yaoyuan860710",
//     	"phone": "18919960205",
//     	"session": "9f740aaf1c0f4a1ca19bd808b180bc42",
//     	"idtype": 0,
//     	"aac005": 11,
//     	"aac004": 1
    	
    	$requestData['sn'] = null;
    	$requestData['sipwd'] = "yaoyuan860710";
    	$requestData['aac006'] = "6201211986071";
    	$requestData['account'] = "yy86710";
    	$requestData['code'] = "731328";
    	$requestData['email'] = "yy86710@126.com";
    	$requestData['idno'] = "620121198607100032";
    	$requestData['sino'] = "1000785163";
    	$requestData['name'] = "姚远";
    	$requestData['password'] = "yaoyuan860710";
    	$requestData['phone'] = "18919960205";
    	$requestData['session'] = "9f740aaf1c0f4a1ca19bd808b180bc42";
    	$requestData['idtype'] = 0;
    	$requestData['aac005'] = 11;
    	$requestData['aac004'] = 1;
    	$http = new Http();
    	dump($http ->getHttpResponse("http://61.178.73.134:8090/passport/reg/Mobile/submit.action", $requestData , "POST" ,array("Content-type: text/htmlapplication/json;charset=UTF-8")) );
    	
    }
}




class test{
	public $name = "1";
	public $email = "test@qq.com";
}
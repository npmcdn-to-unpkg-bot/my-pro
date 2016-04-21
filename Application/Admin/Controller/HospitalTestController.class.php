<?php
namespace Admin\Controller;

use Admin\Common\CommonController;
use Org\Net;
use Org\Net\Http;

class HospitalTestController extends CommonController{
	
	private  $ip = "202.100.81.123:9087";
	
	private $access_token = "LACiA83Hr7TITJ9ybmUMaRBO_K_Kvpbtu0nChRhKCZOGi8preK3P5Gw72ekNFzNI88opgpMGUxN6bjrPMCqkJQ";
	
	function getData(){
		
		
		
		$header = array("Content-type:text/html; charset=utf-8");
		if("token" == I('type')){
			$url = $this -> ip . "/oauth2/token";
			$param = array("grant_type" => "CLIENT_CREDENTIALS" , "client_id"=>"ICITY_10001" , "client_secret" => "229FECFDC6F93C9EE05359CBA8C0CDD6229FECFDC6FA3C9EE05359CBA8C0CDD6" , "redirect_uri" => "118.180.8.42");
			$data = Http::getResponse($url , $param , 'GET' , $header);
		
			$result = json_decode($data, true);
		}
		
		if("doc" == I('type')){
			$url = $this -> ip . "/doctor/list/doc";
			$param = array(
					"access_token" => $this -> access_token,
					"param" => "29483562388C28B0E05358CBA8C0F683"
			);
			$data = Http::getResponse($url , $param , 'GET' , $header);
			$result = json_decode($data, true);
		}
		
// 		http://202.100.81.123:8060/arweb-s-engine/image?type=doc_image&param=4028818d260371930126133af3d80139
		
		if("image" == I('type')){
			$url = "202.100.81.123:8060/arweb-s-engine/image";
			$param = array(
					//"access_token" => $this -> access_token,
					"type" => "doc_image",
					"param" => "29483562388C28B0E05358CBA8C0F683"
			);
// 			$data = Http::getResponse($url , $param , 'GET' , $header);
			http::curlDownload("http://202.100.81.123:8060/arweb-s-engine/image?type=doc_image&param=29483562388C28B0E05358CBA8C0F683" , "./test.jpg");
// 			$result = json_decode($data, true);
		}
		
		
		
		$this -> assign("ret" , $result);
		$this -> display();
	}
	
	
}
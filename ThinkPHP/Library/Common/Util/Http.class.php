<?php
/**
*类注释
*用途：
*@作者：yaoyuan
*@时间：2015年12月28日 下午4:21:26
*/

namespace Common\Util;

class Http{
	 /**
	 * 发送HTTP请求方法
	 * @param  string $url    请求URL
	 * @param  array  $params 请求参数
	 * @param  string $method 请求方法GET/POST
	 * @return array  $data   响应数据
	 */
	 public function getHttpResponse($url, $params, $method = 'GET', $header = array(), $multi = false){
	    $opts = array(
	            CURLOPT_TIMEOUT        => 30,
	            CURLOPT_RETURNTRANSFER => 1,
	            CURLOPT_SSL_VERIFYPEER => false,
	            CURLOPT_SSL_VERIFYHOST => false,
	            CURLOPT_HTTPHEADER     => $header
	    );
	    /* 根据请求类型设置特定参数 */
	    switch(strtoupper($method)){
	        case 'GET':
	            $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
	            break;
	        case 'POST':
	            //判断是否传输文件
	            $params = $multi ? $params : http_build_query($params);
	            $opts[CURLOPT_URL] = $url;
	            $opts[CURLOPT_POST] = 1;
	            $opts[CURLOPT_POSTFIELDS] = $params;
	            break;
	        default:
	            throw new Exception('不支持的请求方式！');
	    }
	    /* 初始化并执行curl请求 */
	    $ch = curl_init();
	    curl_setopt_array($ch, $opts);
	    $data  = curl_exec($ch);
	    $error = curl_error($ch);
	    curl_close($ch);
	    $info = curl_getinfo($ch);
	    if($error) throw new Exception('请求发生错误：' . $error);
	    return  $data;
	 }
	
}
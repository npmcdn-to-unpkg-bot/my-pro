<?php
return array (
		// '配置项'=>'配置值'
		'LAYOUT_ON' => true,
		'LAYOUT_NAME' => 'layout',
		'HTML_CACHE_ON' => false,
		'PhpConsole' => true,
		'IOS_APP_KEY' => '@5b7e2ebd-f26a-d8e3-0893-fdef6efb2fa6',
		'ANDROID_APP_KEY' => '@e5e71e48-9bd9-ee15-d46e-8f8a01f7119a',
		'APPK_LIST' => array(
				'97f3f5c66b62b7fa318061904aaf77f0'=>array('APP_KEY'=>'@a71db034-3f93-56d3-b17b-2f6e096fc951' , 'USE' => false),
		),
		'INTERFACE_AUTH_PREFIX' =>'@vipcar',
		'IOS_CLIENT_TYPE' => 'iOS',
		'ANDROID_CLIENT_TYPE' => 'Android',
		'LOG_RECORD' => true,//开起日志记录
		'ERROR_CODE' => array(
				'CLIENT_TYPE_ERROR' => array('CODE' => '0000' , 'MSG' => '使用非法的客户端'),
				'SIGNATURE_ERROR' => array('CODE' => '0001' , 'MSG' => '接口签名校验失败'),
				'APP_KEY_ILLEGAL' => array('CODE' => '0002' , 'MSG' => '接口使用非法的APPKEY'),
				'APP_KEY_INVALID' => array('CODE' => '0003' , 'MSG' => '接口APPKEY失效'),
				'VALIDATE_PARAM_EMPTY' => array('CODE' => '0004' , 'MSG' => '接口验证参数缺失'),
		),
		'SUCCESS_CODE' => array(
				'CODE' => '200',
				'MSG' => '接口调用成功',
				),
);
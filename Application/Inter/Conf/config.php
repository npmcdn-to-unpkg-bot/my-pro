<?php
return array (
		// '配置项'=>'配置值'
		'LAYOUT_ON' => true,
		'LAYOUT_NAME' => 'layout',
		'HTML_CACHE_ON' => false,
		'PhpConsole' => true,
		'IOS_APP_KEY' => '@5b7e2ebd-f26a-d8e3-0893-fdef6efb2fa6',
		'ANDROID_APP_KEY' => '@e5e71e48-9bd9-ee15-d46e-8f8a01f7119a',
		'INTERFACE_AUTH_PREFIX' =>'@vipcar',
		'IOS_CLIENT_TYPE' => 'iOS',
		'ANDROID_CLIENT_TYPE' => 'Android',
		'LOG_RECORD' => true,//开起日志记录
		'ERROR_CODE' => array(
				'CLIENT_TYPE_ERROR' => array('CODE' => '0000' , 'MSG' => '使用非法的客户端'),
				'SIGNATURE_ERROR' => array('CODE' => '0001' , 'MSG' => '接口签名校验失败'),
		),
		'SUCCESS_CODE' => array(
				'CODE' => '200',
				'MSG' => '接口调用成功',
				),
		'URL_PREFIX' => 'http://int.gsvipcar.cn:8001',
		'TEST_URL_PREFIX' => 'http://int.gsvipcar.cn:8001',
);
<?php
return array(
	//'配置项'=>'配置值'
		// 添加数据库配置信息
		'DB_TYPE'=>'mysql',// 数据库类型
		'DB_HOST'=>'127.0.0.1',// 服务器地址
		'DB_NAME'=>'MyPro',// 数据库名
		'DB_USER'=>'mypro',// 用户名
		'DB_PWD'=>'000000',// 密码
		'DB_PORT'=>3306,// 端口
		'DB_PREFIX'=>'yybg_',// 数据库表前缀
		'DB_CHARSET'=>'utf8',// 数据库字符集
		'DEFAULT_AJAX_RETURN'   =>  'JSON',//默认返回格式
		'DEFAULT_CHARSET' =>  'utf-8', // 默认输出编码
		//配置默认模板形式为PHP
		'TMPL_TEMPLATE_SUFFIX'=>'.php',
		'URL_MODEL' => URL_REWRITE,
		'URL_HTML_SUFFIX'=>'',
// 		'TAGLIB_PRE_LOAD' => 'Util',
		'DEFAULT_PSW' => '123456',
		//'配置项'=>'配置值' 配置模板替换
		'TMPL_PARSE_STRING'  =>array(
				'__JS_RES__' => __ROOT__.'/Public' .'/JsResources', // 配置javascript资源位置
				'__STYLE_RES__' => __ROOT__.'/Public' .'/StyleResources', // 配置Css样式表资源位置
				'__IMG_RES__' => __ROOT__.'/Public' .'/ImgResources', // 配置所用图片资源位置
				'__FILE_RES__' => __ROOT__.'/Public' .'/FileResources', // 配置所用图片资源位置
				'__UEDIT__' => __ROOT__.'/Public' .'/uedit', // 配置Uedit位置
		),
		//配置默认模块
		'MODULE_ALLOW_LIST' => array ('Admin' , 'Home' , 'Inter'),
		'DEFAULT_MODULE' => 'Admin',
		'URL_PREFIX' => 'http://int.gsvipcar.cn:8001',
		'TEST_URL_PREFIX' => 'http://int.gsvipcar.cn:8001',
);
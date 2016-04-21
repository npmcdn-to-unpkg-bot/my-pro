<?php
return array (
		// '配置项'=>'配置值'
		'LAYOUT_ON' => true,
		'LAYOUT_NAME' => 'layout',
		// 配置seesion
		'SESSION_OPTIONS' => array (
				'name' => 'yybg_session',
				'expire' => 24*3600 ,
				'use_trans_sid' => 1, //跨页传递
				'use_only_cookies' =>  0,//是否只开启基于cookies的session的会话方式
		) ,
);
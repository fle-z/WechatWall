<?php
return array(
	'DEFAULT_MODULE'       =>    'Home', //默认模块
	//*********************************附加设置***********************************
	'LOAD_EXT_CONFIG' => 'constant,db,webconfig,oauth',	// 加载扩展配置文件
	'TAGLIB_BUILD_IN'       =>  'Cx,Common\Tag\My',           //加载自定义标签
	'TMPL_PARSE_STRING'     =>  array(
			'__CSS__'						=>  __ROOT__.'/Public/static/css',
			'__JS__'						=>  __ROOT__.'/Public/static/js',
			'__IMAGE__'						=>  __ROOT__.'/Public/static/image',
			'__HTML__'						=>  __ROOT__.'/Public/static/html',
	),

	//***********************************URL设置*********************************
	'MODULE_ALLOW_LIST'    =>    array('Home'),//设置访问列表
	'TMPL_EXCEPTION_FILE'   =>  APP_DEBUG ? THINK_PATH.'Tpl/think_exception.tpl' : './Applications/Public/404.html',  //404设置

	//***********************************URL*************************************
	'URL_MODEL'          => '1', //URL模式

//***********************************其他设置*********************************
	//'TMPL_L_DELIM' => '{',//模板引擎左定界符
	//'TMPL_L_DELIM' => '}',//右

	'SHOW_PAGE_TRACE' => true,

	'URL_HTML_SUFFIX' => '.html'
);
?>

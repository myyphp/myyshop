<?php
return array(
	//'配置项'=>'配置值'

    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    'URL_CASE_INSENSITIVE'  =>   true,    //不区分大小写

    /*文件上传模块*/
	'IMG_maxSize' => '3M',
	'IMG_exts' => array('jpg', 'pjpeg', 'bmp', 'gif', 'png', 'jpeg'),
	'IMG_rootPath' => './Public/Uploads/',
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'myshop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'myy545',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sh_',    // 数据库表前缀
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    
    /* 设置模板替换变量 */
    'TMPL_PARSE_STRING'     => array(
            '__ADMIN__'=>'/Public/Admin',
             
    ),
        
   //分页时的每页显示数量
   'PAGE_SHOW_COUNT'    => 5,
        
   //修改I函数使用的函数
   'DEFAULT_FILTER'     => "trim,removeXSS",
        
   //md5加密key
   "MD5_KEY"    =>  "db22e0df8efa15d9b2a3058dbebce158",
   
        
        
        
);
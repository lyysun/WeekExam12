<?php
return array(
	'logs'=>array(
		'path'=>'backup/logs',
		'type'=>'file'
	),
	'DB'=>array(
		'type'=>'mysqli',
        'tablePre'=>'iwebshop_',
		'read'=>array(
			array('host'=>'localhost:3306','user'=>'root','passwd'=>'root','name'=>'iweb'),
		),

		'write'=>array(
			'host'=>'localhost:3306','user'=>'root','passwd'=>'root','name'=>'iweb',
		),
	),
	'interceptor' => array('themeroute@onCreateController','layoutroute@onCreateView','plugin'),
	'langPath' => 'language',
	'viewPath' => 'views',
	'skinPath' => 'skin',
    'classes' => 'classes.*',
    'rewriteRule' =>'url',
	'theme' => array('pc' => array('huawei' => 'default','sysdefault' => 'default','sysseller' => 'default'),'mobile' => array('mobile' => 'default','sysdefault' => 'default','sysseller' => 'default')),
	'timezone'	=> 'Etc/GMT-8',
	'upload' => 'upload',
	'dbbackup' => 'backup/database',
	'safe' => 'cookie',
	'lang' => 'zh_sc',
	'debug'=> '1',
	'configExt'=> array('site_config'=>'config/site_config.php'),
	'encryptKey'=>'108594f63376e0f882c9bc68e0d7d132',
	'authorizeCode' => '',
	'uploadSize' => '10',
);
?>
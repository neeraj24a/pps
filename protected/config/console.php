<?php
require_once "modulesconfig.php";
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Premier PC Support',

	// preloading 'log' component
	'preload'=>array('log'),
    //'preload'=>array('log'),
    'timeZone'=>'America/New_York',
    'sourceLanguage' => 'en',
    'language' => 'en',


	// autoloading model and component classes
	'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.helpers.*',
        'ext.mail.YiiMailMessage',
        'application.modules.simpleMailer.components.*',
		'application.modules.simpleMailer.models.*',
    ),
	  'modules'=>$modulesConfig,
	// application components
	'components'=>array(

    // 'db'=>array(
	//		'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	//	),
        
		// uncomment the following to use a MySQL database
	'db'=>array(
        'connectionString' => 'mysql:host=127.0.0.1;dbname=mrp',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'tablePrefix'=>'tbl_',
        'enableProfiling'=>true,
        'enableParamLogging'=>true,
	),
    
    'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);
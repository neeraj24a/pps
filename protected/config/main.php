<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once "modulesconfig.php";
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Premier PC Support',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),
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



    /*
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	
	),	*/

    'modules'=>$modulesConfig,
    
	// application components
	'components'=>array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
            'loginUrl' => array('user/login'),
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
            'responsiveCss' => true,
        ),        
                           
		// uncomment the following to enable URLs in path-format
        
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
        
		'mail' => array(
 			'class' => 'ext.yii-mail.YiiMail',
 			'transportType' => 'php',
 			'viewPath' => 'application.views.email',
 			'logging' => true,
 			'dryRun' => false
 		),
        
        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),
        'settings' => array(
            'class' => 'application.extensions.SysSettings',
            'cacheComponentId' => 'cache',
            'cacheId' => 'global_website_settings',
            'cacheTime' => 84000,
            'tableName' => 'settings',
            'dbComponentId' => 'db',
            'createTable' => true,
            'dbEngine' => 'InnoDB',
        ),


		'db'=>array(
        
            'connectionString' => 'mysql:host=localhost;dbname=tecnotic_mrp',
            'emulatePrepare' => true,
            'username' => 'tecnotic_mrp',
            'password' => 'jose123',
            'charset' => 'utf8',
            'tablePrefix'=>'tbl_',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,

          
		),
      
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        
   'log'=>array(
    'class'=>'CLogRouter',
    'routes'=>array(
    /*
      array(
        'class'=>'CWebLogRoute',  'levels'=>'trace1, info1, error, warning1',
      ),
      */
      array(
        'class'=>'CFileLogRoute',  'levels'=>'error, warning',
      ),
    )
  )
),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'pps@cc-usa.co',
        'mode'=>'prod',
        'emailtest'=>'test@cc-usa.co',
        'logmein_email'=>'jose@test.com',
        'logmein_password'=>'Password1',
        'logmein_pps_iNodeID'=>'862904309',// Premier PC Support
	),
);
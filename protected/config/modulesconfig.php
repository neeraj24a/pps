<?php
	$modulesConfig=array(
      'user'=>array(
                # encrypting method (php hash function)
                'hash' => 'md5',
                # send activation email
                'sendActivationMail' => true,
                # allow access for non-activated users
                'loginNotActiv' => false,
                # activate user on registration (only sendActivationMail = false)
                'activeAfterRegister' => false,
                # automatically login from registration
                'autoLogin' => true,
                # registration path
                'registrationUrl' => array('/user/registration'),
                # recovery password path
                'recoveryUrl' => array('/user/recovery'),
                # login form path
                'loginUrl' => array('/user/login'),
                # page after login
                'returnUrl' => array('/dashboard'),
                # page after logout
                'returnLogoutUrl' => array('/user/login'),
            ),
      'schedule', 
      'report',    
      'dashboard' => array(
      'debug' => false,
      'portlets' => array(
            'Surveys' => array('class' => 'Surveys', 'visible' => true, 'weight' => 1,'column'=>0,), 
            'Sessions' => array('class' => 'Sessions', 'visible' => true, 'weight' => 5,'column'=>1, ),
            'ActiveSessions' => array('class' => 'ActiveSessions', 'visible' => true, 'weight' => 10,'column'=>2, ),
            'UsersOnline' => array('class' => 'UsersOnline', 'visible' => true, 'weight' => 15,'column'=>2,),
            'SurveysOfTech' => array('class' => 'SurveysOfTech', 'visible' => true, 'weight' => 20,'column'=>0 ,),
            'SessionChartMonth' => array('class' => 'SessionChartMonth', 'visible' => true, 'weight' => 30,'column'=>1, ),
            'SurveyBar' => array('class' => 'SurveyBar', 'visible' => true, 'weight' => 40,'column'=>1, ),
        
      ),
    ),  
         'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'jose123',
             'generatorPaths'=>array(
             'ext.giiplus',
             'bootstrap.gii',
             ),
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
		),
        
        'simpleMailer' => array(
		    'attachImages' => false, // This is the default value, for attaching the images used into the emails.
		    'sendEmailLimit'=> 100, // Also the default value, how much emails should be sent when calling yiic mailer
		),
		  
	);
    
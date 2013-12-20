<?php
	$clientScript = array(
       'packages' => array(
          'datetime'=>array(
             'basePath'=> 'application.extensions.timepicker.assets',   
             'css'    => array( 'css/timepicker.css','css/ui.theme.smoothness/jquery-ui-1.7.3.css'),
             'js'     => array('js/jquery.ui.timepicker.js' ,'js/jquery.ui.timepicker.vi.js'),
             'depends'=>array('jquery','jquery.ui'),
          ),
    )
);
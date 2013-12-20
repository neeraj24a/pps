<?php

class ScheduleModule extends CWebModule
{
    
    public $debug = false;
      
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
        
		$this->setImport(array(
			'schedule.models.*',
			'schedule.components.*',
		));

   if( $this->debug == false)
    {
      $this->tableCreate();
    }
            
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
    
    
	protected function tableCreate()
	{
	  $db = Yii::app()->db;
    if($db)
    {
        $transaction = $db->beginTransaction();
        
    if(!in_array('schedule_scheduling', $db->getSchema()->tableNames))
        {
            $sql = "CREATE TABLE `schedule_scheduling` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `user_id` int(11) NOT NULL,
                  `username` varchar(255) DEFAULT NULL,
                  `note` varchar(255) DEFAULT NULL,
                  `date` date NOT NULL,
                  `starttime` time NOT NULL,
                  `endtime` time NOT NULL,
                  `repeat` tinyint(4) DEFAULT NULL,
                  `status` tinyint(4) DEFAULT '1',
                  `calloff` tinyint(4) DEFAULT NULL,
                  `notecalloff` varchar(255) DEFAULT NULL,
                  `acceptcalloff` tinyint(4) DEFAULT NULL,
                  `swap_id` int(11) DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `user_id` (`user_id`,`date`),
                  CONSTRAINT `schedule_scheduling_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_profiles` (`user_id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;";
            $db->createCommand($sql)->execute();
        }
        
                
        if(!in_array('schedule_swap', $db->getSchema()->tableNames))
        {
            $sql = " CREATE TABLE `schedule_swap` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `createdate` date NOT NULL,
                  `scheduling_from_id` int(11) NOT NULL,
                  `scheduling_to_id` int(11) NOT NULL,
                  `note` varchar(255) DEFAULT NULL,
                  `acceptdate` date DEFAULT NULL,
                  `user_request` int(11) DEFAULT NULL,
                  `user_accept` int(11) DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `scheduling_from_id` (`scheduling_from_id`),
                  KEY `schedunling_to_id` (`scheduling_to_id`),
                  CONSTRAINT `schedule_swap_ibfk_1` FOREIGN KEY (`scheduling_from_id`) REFERENCES `schedule_scheduling` (`id`),
                  CONSTRAINT `schedule_swap_ibfk_2` FOREIGN KEY (`scheduling_to_id`) REFERENCES `schedule_scheduling` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
            $db->createCommand($sql)->execute();
        }
       
        if(!in_array('schedule_repeat', $db->getSchema()->tableNames))
        {
            $sql = "        CREATE TABLE `schedule_repeat` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) DEFAULT NULL,
          `applydate` date DEFAULT NULL,
          `mon` tinyint(1) DEFAULT NULL,
          `tue` tinyint(1) DEFAULT NULL,
          `web` tinyint(1) DEFAULT NULL,
          `thu` tinyint(1) DEFAULT NULL,
          `fri` tinyint(1) DEFAULT NULL,
          `sat` tinyint(1) DEFAULT NULL,
          `sun` tinyint(1) DEFAULT NULL,
          `totalweeks` int(11) DEFAULT NULL,
          `pause` int(1) DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `user_id` (`user_id`),
          CONSTRAINT `schedule_repeat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_profiles` (`user_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1; ";
            $db->createCommand($sql)->execute();
        }       

        $transaction->commit();
    }
    else
    {
      throw new CException('Database connection is not working');
    }
	}
        
}

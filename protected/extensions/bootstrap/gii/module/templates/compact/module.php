<?php echo "<?php\n"; ?>

class <?php echo $this->moduleClass; ?> extends CWebModule
{
   
   public $menuFunc=array();
   
   public $defaultUrl = '/<?php echo $this->moduleID; ?>/default/index';
   
   /**
	* @property string the path to the layout file to use for displaying Rights.
	*/
	public $layout = '<?php echo $this->moduleID; ?>.views.layouts.main';
	/**
	* @property string the path to the application layout file.
	*/
	public $appLayout = 'application.views.layouts.main';
    
   
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'<?php echo $this->moduleID; ?>.models.*',
			'<?php echo $this->moduleID; ?>.components.*',
		));
        
      $this->menuFunc=array();  
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
}

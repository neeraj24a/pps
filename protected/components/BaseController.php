<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BaseController extends Controller
{
    
  public $mRef='';
        
  	/**
	 * @return array action filters
	 */
	public function filters1()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
    

	/**
	* Initializes the controller.
	*/
	public function init()
	{
	  Yii::app()->clientScript->registerPackage('datetime');
	   
		//$this->_authorizer = $this->module->getAuthorizer();
        if(isset($this->module->layout))
		$this->layout = $this->module->layout;
         $this->mRef= Yii::app()->request->getQuery('module');
		//$this->defaultAction = 'view';
		// Register the scripts
         //echo "sdsadsadsad";
        //if(isset($this->module->registerScripts)){
        //    echo "sdsadsadsad";
        if(function_exists('$this->module->registerScripts()')) 
	   	   $this->module->registerScripts();
       // }
	}
        
    

     
  
}
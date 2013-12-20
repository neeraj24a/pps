<?php

class SaleController extends Controller
{
    
  /**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('index'),
				'users'=>array('@')
			),
            
            array('allow', 
				'actions'=>array('list','GenerateExcel','customers','Editable'),
				'users'=>array('@')
			),
            
            
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','view'),
				'users'=>array('admin'),
			),
            
			array('deny',  // deny all users
				'users'=>array('*'),
			),            
            
		);
	}
    

    
    
    
	public function actionIndex()
	{
	if (isset($_GET['pageSize'])) {
             Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
             unset($_GET['pageSize']);
        }
       
       
	   $session=new CHttpSession;
       $session->open(); 
		$model=new Customerlog('search');
		$model->unsetAttributes();  // clear any default values
        
        
		if(isset($_GET['Customerlog']))
			$model->attributes=$_GET['Customerlog'];
        $session['Customerlog_dataProvider']=$model->search();
        
		$this->render('index',array(
			'model'=>$model,
		));
	}
    
    
    
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


     
    
    
  public function actionEditable()
        {
            
           Yii::import('bootstrap.widgets.TbEditableSaver');
            $es = new TbEditableSaver('Customerlog');
            /*
            $es->onBeforeUpdate = function($event) {
                $event->sender->setAttribute('updated_at', date('Y-m-d H:i:s'));
            };
            */
            $es->update();
        }

 
 

public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		

           if(isset($session['Customerlog_dataProvider']))
                 {
                  $dataProvider=$session['Customerlog_dataProvider'];
                 }
           else
	      $dataProvider = new CActiveDataProvider('Customerlog');
            
			$this->renderPartial('excelReport', array(
				'dataProvider'=>$dataProvider
			));
	}
              
    
      
    
    	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Customerlog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
 
 
}
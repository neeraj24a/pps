<?php

class QcController extends Controller
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
				'actions'=>array('list','Editable','GenerateExcel'),
				'users'=>array('@')
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),            
            
		);
	}
    
    
 	/**
	 * Manages all models.
	 */
	public function actionList()
	{
	     if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
             unset($_GET['pageSize']);
        }
        
	   $session=new CHttpSession;
       $session->open(); 
		$model=new Survey('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Survey']))
			$model->attributes=$_GET['Survey'];
        $session['qc_dataProvider']=$model->qc()->search();
        
		$this->render('list',array(
			'model'=>$model,
		));
	}
    
    
    
    
  public function actionEditable()
        {
            
           Yii::import('bootstrap.widgets.TbEditableSaver');
           $es = new TbEditableSaver('Survey');
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
           if(isset($session['qc_dataProvider']))
                 {
                  $dataProvider=$session['qc_dataProvider'];
                 }
           else
	      $dataProvider = new CActiveDataProvider('Survey');
            
			$this->renderPartial('excelReport', array(
				'dataProvider'=>$dataProvider
			));
            
	/*
		Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('excelReport', array(
				'dataProvider'=>$dataProvider
			), true)
		);
        */
	}
  
    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Survey::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
 
}
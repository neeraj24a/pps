<?php

class SurveyController extends Controller
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
				'actions'=>array('index','getdata'),
				'users'=>array('*')
			),
            
            array('allow', 
				'actions'=>array('List','GenerateExcel','customers','GenerateExcelCus','Editable'),
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
    
    	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
       $models=Sessionlog::model()->findAll("SessionID=$id");
		$this->render('view',array(
			'models'=>$models 
		));
	}
    
    
    
	public function actionIndex()
	{
	if(isset($_POST['SurveyForm']) &&  isset($_GET['RescueSessionID'])){
          $SessionID=$_GET['RescueSessionID'];
          $survey = Survey::model()->find("SessionID=$SessionID") ;
          if(!isset($survey))  $survey = new Survey();
            $survey->SessionID=$_GET['RescueSessionID'];
            $survey->Status=$_POST['SurveyForm']['status'];
            $survey->Rate=$_POST['SurveyForm']['rate'];
            if(!isset($_POST['SurveyForm']['rate']))
            {
                $survey->Rate=2;
            }
            
            $survey->Comment=$_POST['SurveyForm']['comment'];
            $survey->CreateDate= date('y-m-d H:i:s',time());
            
            for($i=0;$i<=5;$i++){
            $f= "CField$i"; 
            if(isset($_GET[$f]))
             $survey->$f=$_GET[$f];
            }
            $survey->Comment=$_POST['SurveyForm']['comment'];
            if($survey->save(false)){
            try {
                
               $this->autoSendEmailToClient($survey);
               $this->sendEmails($survey);
               $this->updateCust($survey);
               $this->updateTechName($survey);
               }catch (Exception $e){
                  Yii::log($e->message);
               }
            }
        $this->redirect(array('index'));         
       }
	   $this->render('index');
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


 
 	/**
	 * Manages all models.
	 */
	public function actionList()
	{
	     if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
             unset($_GET['pageSize']);
        }
       if(isset($_POST['SendEmailForm'])){
        $this->sendEmailToClients($_POST['SendEmailForm']);
       }
        
	   $session=new CHttpSession;
       $session->open(); 
		$model=new Survey('search');
		$model->unsetAttributes();  // clear any default values
        
       if(!Helper::isAdmin())
       $model=$model->ByTech();
       
		if(isset($_GET['Survey']))
			$model->attributes=$_GET['Survey'];
        $session['Survey_dataProvider']=$model->search();
        
		$this->render('list',array(
			'model'=>$model,
		));
	}
    

 //Send an email to client
 private function sendEmailToClients($p)
    {
        try {
          $ids=$p['ids'];
          $template_name=$p['template_name'];
          //$list_name=$p['list_name'];
          
          $template_partials=array();
          
            $arIds="";
            foreach($l=explode(',',$ids) as $id){
                if($id>0){
                if($arIds=="")    
                    $arIds=$id;
                else $arIds=$arIds.",".$id;    
                }
            } 
             
             if($arIds!==""){
               $sql= " SELECT DISTINCT Email,Name from  survey where id in($arIds)";
               $list= Yii::app()->db->createCommand($sql)->queryAll();
                foreach ($list as $item ) {
               if(isset($item['Email'])){   
                $email=trim($item['Email']);
                 if(Yii::app()->params['mode']=='test'){
                     $email=Yii::app()->params['emailtest'];
                     }
                 $template_vars = array(
                  '__username__' => $item['Name'],
                    );
                   SimpleMailer::send($email,$template_name,$template_vars);
                 }
               }
              }
        }
        catch(Exception $e){
            Yii::log($e->message);
        }   
 }
        
//Send email to admins if has a disappointing review 
 private function sendEmails($survey)
    {
        try {
        if($survey->Rate==1){
            Yii::import('ext.yii-mail.YiiMailMessage');
            $list= Yii::app()->settings->get('setting','emails');
            foreach ($items=explode(",",$list) as $item ) {
             $message = new YiiMailMessage;
             $message->view='emaildisappointing';
             $message->setBody(array('survey'=>$survey),'text/html');
             $message->subject = '[Premier PC Support] disappointing review ';
             $message->addTo(trim($item));
             $message->from = Yii::app()->params['adminEmail'];
             Yii::app()->mail->send($message);
           }  
        } }
        catch(Exception $e){
            Yii::log($e->message);
        }
    }
  
   
 private function autoSendEmailToClient($survey)
    {
       try{
        if($survey->Rate>0){
        $m= SimpleMailerSetting::model()->find("rate=$survey->Rate");
        if(isset($m)){
            
             $email=trim($survey->Email);
             if(Yii::app()->params['mode']=='test')
             $email=Yii::app()->params['emailtest'];
             $template_vars = array(
              '__username__' => $survey->Name,
                );
               
           SimpleMailer::send($email,$m->template->name,$template_vars);
        }
        }
        } catch(Exception $e){
             Yii::log($e->getMessage());
        }
    }

   
  public function updateCust($survey){
    try {
    
         //check existing, update customer
        if($survey->Rate<3) return; 
        $cus=Customerlog::model()->find("Email='$survey->Email'");
        if(!isset($cus) || ($cus==null)){
            $cus= new Customerlog();
            $cus->Name=$survey->Name;
            $cus->Email=$survey->Email;
            $cus->Phone=$survey->Phone;
            $cus->CreateDate=$survey->CreateDate;
            $cus->Status=0;
            $cus->Rate=$survey->Rate;
            $cus->save(false);
        }
        }
        catch(Exception $e){
             Yii::log($e->getMessage());
        }
   } 
   
   
 public function updateTechName($survey){
    try {
        $log=Sessionlog::model()->find("SessionID=$survey->SessionID");
        if(!isset($log)){
            $survey->TechID=$log->TechID;
            $survey->TechName=$log->TechName;
            $survey->TechEmail=$log->TechEmail;
            $survey->save(false);
        }
        }
        catch(Exception $e){
             Yii::log($e->getMessage());
        }
   } 
     
  public function actionEditable()
        {
           Yii::import('bootstrap.widgets.TbEditableSaver');
            $es = new TbEditableSaver('Customerlog');
            $es->update();
        }

 
 	/**
	 * Manages all models.
	 */
	public function actionCustomers()
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
        
		$this->render('customerlog',array(
			'model'=>$model,
		));
	}
   

public function actionGenerateExcelCus()
	{
            $session=new CHttpSession;
            $session->open();		
           if(isset($session['Customerlog_dataProvider']))
                 {
                  $dataProvider=$session['Customerlog_dataProvider'];
                 }
           else
	      $dataProvider = new CActiveDataProvider('Customerlog');
            
			$this->renderPartial('excelReportCus', array(
				'dataProvider'=>$dataProvider
			));
	}
              
    
public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
           if(isset($session['Survey_dataProvider']))
                 {
                  $dataProvider=$session['Survey_dataProvider'];
                 }
           else
	      $dataProvider = new CActiveDataProvider('Survey');
            
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
		$model=Survey::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
 
 
}
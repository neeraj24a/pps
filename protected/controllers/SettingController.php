<?php
class SettingController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return CMap::mergeArray(parent::filters(), array('accessControl',
            // perform access control for CRUD operations
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
       array('allow','actions' => array('Emails'), 'users' => array('admin'), ),
       array('deny', // deny all users
            'users' => array('*'), ), );
    }

    public function actionEmails(){
        
      
        
      $e= new  EmailSettings();
      $e->emails= Yii::app()->settings->get('setting','emails');
      $e->emailtoCus= Yii::app()->settings->get('setting','emailtoCus');
     
      if(isset($_POST['EmailSettings'])){
        
      if(isset($_POST['SaveEmails'])){  
          $e->emails =  $_POST['EmailSettings']['emails'];
          Yii::app()->settings->set('setting',"emails",$e->emails );
      }
      
      if(isset($_POST['saveEmailtoCus'])){  
          $e->emailtoCus =  $_POST['EmailSettings']['emailtoCus'];
          Yii::app()->settings->set('setting',"emailtoCus",$e->emailtoCus );
      }
        
      }
      
      $this->render('emails',array('model'=>$e));
	}
}

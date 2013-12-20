<?php

class SessionController extends Controller
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
        array('allow', 'actions' => array('getdata'), 'users' =>
            array('*')), 
            
            array('allow', 'actions' => array('index', 'GenerateExcel'),
            'users' => array('@')), array('allow',
            // allow admin user to perform 'admin' and 'delete' actions
            'actions' => array('admin', 'delete', 'view','TestEmail','UpdateName'), 'users' => array('admin'), ),
            array('deny', // deny all users
            'users' => array('*'), ), );
    }


    public function fixdata($data)
    {
        preg_match_all('/(\d+:\d+)\s*(AM|PM)/', $data, $match, PREG_PATTERN_ORDER);
        $t = '';
        foreach ($match[0] as $item)
        {
            if ($t !== $item)
            {
                $data = str_replace($item, '<br>' . $item, $data);
                $t = $item;
            }
        }
        return $data;
    }

    public function viewChat($data, $row)
    {
        $html = "<a onClick='$(\"#mod$row\").modal()'>View</a>";
        $html .= "<div id='mod$row' style='display:none' class='modal' >";
        $html .= '<div class="modal-header">';
        $html .= '<a class="close" data-dismiss="modal">X</a>';
        $html .= '<h4>Chat log</h4>';
        $html .= '</div>';
        $html .= '<div class="modal-body">';
        $html .= $this->fixdata($data->ChatLog);
        $html .= '</div>';
        $html .= "</div>";
        return $html;
    }

    public function actionIndex()
    {
        if (isset($_GET['pageSize']))
        {
            Yii::app()->user->setState('pageSize', (int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $session = new CHttpSession;
        $session->open();
        $model = new Sessionlog('search');
        $model->unsetAttributes(); // clear any default values
        
       if(!Helper::isAdmin())
       $model=$model->ByTech();
        
        if (isset($_GET['Sessionlog']))
            $model->attributes = $_GET['Sessionlog'];
        $session['Sessionlog_dataProvider'] = $model->search();
        $this->render('index', array('model' => $model, ));
    }


    public function actionTestEmail($id)
    {
     $survey = Survey::model()->find("SessionID=$id");
     $log = Sessionlog::model()->find("SessionID=$id");
      if (isset($survey))
        {
            $survey->TechID = $log->TechID;
            $survey->TechEmail = $log->TechEmail;
            $survey->TechName = $log->TechName;
            $survey->save(false);
            $log->ChatLog=$this->fixdata($log->ChatLog);
            if($survey->Rate==1)
            $this->sendEmails($log, $survey);
        }
     exit();
    }
    
    
  public function actionUpdateName($id)
    {
     $survey = Survey::model()->find("SessionID=$id");
     $log = Sessionlog::model()->find("SessionID=$id");
      if (isset($survey))
        {
            $survey->TechID = $log->TechID;
            $survey->TechEmail = $log->TechEmail;
            $survey->TechName = $log->TechName;
            $survey->save(false);
        }
     exit();
    }
    
    

    public function actionGetData()
    {
      if (empty($_POST)){
      exit();
       }
       
     $log = new Sessionlog();
     $log->attributes = $_POST;
     $log->save(false);
     $survey = Survey::model()->find("SessionID=$log->SessionID");

      if (isset($survey))
        {
            $survey->TechID = $log->TechID;
            $survey->TechEmail = $log->TechEmail;
            $survey->TechName = $log->TechName;
            $survey->save(false);
        } 
      exit();
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
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }


    public function actionGenerateExcel()
    {
        $session = new CHttpSession;
        $session->open();
        if (isset($session['Sessionlog_dataProvider']))
            $dataProvider = $session['Sessionlog_dataProvider'];
        else
            $dataProvider = new CActiveDataProvider('Sessionlog');
        $this->renderPartial('excelReport', array('dataProvider' => $dataProvider));
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Sessionlog::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}

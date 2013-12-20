<?php

class ScheduleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
    
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('SetCallOf','CalendarUser','view','LoadEvent','Loadschedule'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','list','editable','index','GetListScheduling'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','admin','delete','editable','AcceptCallOff'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	/**
	 * ScheduleController::actionCreate()
	 * 
	 * @return void
	 */
	public function actionCreate()
	{
		$model=new Schedule;
        $repeat = new Repeat;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Schedule'])){
			$model->attributes=$_POST['Schedule'];
            $model->date=$_POST['Schedule']['scheduledate'];
            $u=User::model()->findByPk($model->user_id);
             $model->username=  $u->username;
             $model->deleteDuplicate($model->user_id,$model->date);
               if($model->save()){
                    $this->redirect(array('index'));
               }            	
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Schedule']))
		{
			$model->attributes=$_POST['Schedule'];
			if($model->save())
				$this->redirect(array('list'));
		}
		$this->render('update',array(
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
		if(Yii::app()->request->isPostRequest){
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex(){
	    $listeven = array();
        $model = new Schedule('search');
        $model->unsetAttributes(); // clear any default values
       if(!Helper::isAdmin())
       $model=$model->ByTech();
        foreach($model->search()->getData() as $item){
           $listeven[] =$item->getEvent();
        }
		$this->render('index',array(
			'listeven'=>$listeven,
		));
	}

  public function actionEditable()
        {
           Yii::import('bootstrap.widgets.TbEditableSaver');
           $es = new TbEditableSaver('Schedule');
            $es->update();
        }



    /**
	 * Lists all models.
	 */
	public function actionList(){
	    if (isset($_GET['pageSize']))
        {
            Yii::app()->user->setState('pageSize', (int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        
      //  var_dump($_GET);
       // die();
        $session = new CHttpSession;
        $session->open();
        $model = new Schedule('search');
        $model->unsetAttributes(); // clear any default values
        
       if(!Helper::isAdmin())
       $model=$model->ByTech();
        
        if (isset($_GET['Schedule']))
            $model->attributes = $_GET['Schedule'];
        $session['Schedule_dataProvider'] = $model->search();
        $this->render('list', array('model' => $model, ));
	}



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Schedule('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['schedule']))
			$model->attributes=$_GET['schedule'];

		$this->render('list',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=schedule::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='schedule-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionLoadEvent(){
         $listeven = array();
        if(isset($_POST['ids'])){
            $listId = $_POST['ids'];
            if(count($listId)>=2){
                if($listId[0]==1&&$listId[1]==1){
                    unset($listId[0]);
                }    
            }
            $criteria=new CDbCriteria;
            $criteria->addInCondition('user_id',$listId);
      		$listScheduling = Schedule::model()->findAll($criteria);
            
            foreach($listScheduling as $item){
                    $listeven[] =$item->getEven();
                }
            }         
        echo CJSON::encode(array('listEvent'=>$listeven));
        exit;
    }
    
  
      public function actionGetListScheduling(){
        $id=-1;
        if($_GET['id'])
        $id =$_GET['id'];
        $s = Schedule::model()->findByPk($id);
        if(isset($s)){
        $date=$s->date;
        $cUser=$s->username;
        }
        
       if (isset($_GET['term']))
         $qterm = '%' . $_GET['term'] . '%';
        else
            $qterm = '%';
        $sql = "SELECT p.*, CONCAT(p.username,' ',p.date) as value  FROM schedule_scheduling p WHERE (p.username<>'$cUser' and p.date>='$date') and (p.username LIKE :qterm or p.date LIKE :qterm) ORDER BY p.username ASC";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
        $result = $command->queryAll();
        echo CJSON::encode($result);
        exit;       
      }
    
    
    public function actionCalendarUser(){
        $listeven = array();
        $criteria=new CDbCriteria;
        $criteria->compare("user_id",Yii::app()->user->id,true);
		$listScheduling = Schedule::model()->findAll($criteria);
        foreach($listScheduling as $item=>$i){
            $timeShiftStart = explode(':',$i->starttime);
            $timeShiftEnd = explode(':',$i->endtime);
            $colorevent ='';
            if($i->calloff!=null){
                if($i->calloff==1){
                    $colorevent ='#0B6138';        
                }else if($i->calloff==2){
                    $colorevent ='#FA5858';
                }else if($i->calloff==3){
                    $colorevent ='#8258FA';
                }
            }
            $listeven[] = array(
                'id'=>$i->id,
                'note'=>$i->notecalloff,
                'title' =>'Name :'.$i->user->lastname,
                'status'=>($i->calloff==null)?"Status:Not set":"Status:Waiting success",
                'description'=>substr('Time: '.$i->starttime,0,-3).'=>'.substr($i->endtime,0,-3),
                'start'=>date('Y-m-d H:i',strtotime($i->date)+($timeShiftStart[0]*60+$timeShiftStart[1])*60),
                'end'=>date('Y-m-d H:i',strtotime($i->date)+($timeShiftEnd[0]*60+$timeShiftEnd[1])*60),
                'allDay'=>false,
                'color' =>$colorevent,
            );
        }
		$this->render('CalendarUser',array(
			'listeven'=>$listeven,
		));
    }


    public function actionAcceptCallOff(){
        $model = $this->loadModel($_POST['sid']);
        if(isset($model)){
           if($_POST['isaccept']==1){
            $model->calloff=2;
           } else $model->calloff=3;
          $model->noteaccept= $_POST['noteaccept'];
         $model->save(false);
         echo "ok"; 
        }
        exit;
    }
    
    public function actionSetCallOffAd(){
        if(isset($_POST['Schedule'])){
            $model = $this->loadModel($_POST['Schedule']['id']);
            die;
            if(isset($_POST['yt0'])){
                $model->calloff=2;
                $model->acceptcalloff=1;
            }else if(isset($_POST['yt1'])){
                $model->acceptcalloff=0;
                $model->calloff=3;
            }
            if($model->save()){
                $this->actionIndex();    
            }    
        }
    }
    public function actionLoadschedule(){
        if(isset($_POST['user_id'])&&isset($_POST['id'])){
            $model = $this->loadModel($_POST['id']);
            $date = $model->date;
            $criteria=new CDbCriteria;
            $criteria->compare("user_id",$_POST['user_id'],true);
            $criteria->compare("date",">= $date",true);
            $listschedule= Schedule::model()->findAll($criteria);
            echo "<option value=''>Select Schedule</option>";
           foreach($listschedule as $value=>$d)
           echo CHtml::tag('option', array('value'=>$d->id),CHtml::encode($d->date),true);
        }
    }
}

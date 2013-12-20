<?php

class DefaultController extends Controller
{
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array(
				'allow',
				'actions' => array(
					'index',
					'test',
                    'cronsendemail'
				),
				'users' => array('admin'),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actionIndex() {
		$this->render('index');
	}

	public function actionTest() {
		echo SimpleMailer::send('bigchirv@gmail.com', 'admin');
	}
    
    public function actionCronSendEmail() {
        $data=array();
        try {
        	$emails = SimpleMailerQueue::model()->findAllByAttributes(
				array(
					'status' => SimpleMailerQueue::STATUS_NOT_SENT,
				),
				array(
					'limit' => Yii::app()->getModule('simpleMailer')->sendEmailLimit,
				)
			);
        
        	if (!$emails) {
				Yii::log(Yii::t('mailer', 'No emails in queue. Exiting.'), 'error', 'application.commands.MailerCommand');
                $data['continue']=false;
                echo json_encode($data);
               	exit(0);
  			   }
			foreach ($emails as $email) {
    			 if(Yii::app()->params['mode']=='test'){
                    $email->to=	Yii::app()->params['emailtest'];	     
    			 }
				if (mail($email->to, $email->subject, $email->body, $email->headers)) {
					$email->status = SimpleMailerQueue::STATUS_SENT;
					$email->save();
				//	echo 'Sent: ' . $email->to . "\n";
				}
			}
        $data['continue']=true;
        echo json_encode($data);
        exit(0);
       } 
      catch (Exception $e) {
			Yii::log($e->getMessage(), 'error', 'application.commands.MailerCommand');
            $data['continue']=false;
            $data['error']=$e->getMessage();
            echo json_encode($data);
			exit(1);
		}
	}
}
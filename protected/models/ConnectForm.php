<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ConnectForm extends CActiveRecord
{
    public $fullname;
	public $username;
	public $password;
    public $email;
    public $phone;
    public $activation_code;


	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
     

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fields the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'connectlog';
	}
         
	public function rules()
	{
		return array(

		//	array('Name,Email,Phone', 'required'),
			array('StatusSurvey', 'numerical', 'integerOnly'=>true),
			array('UserName, Password, Email', 'length', 'max'=>128),
          
   	      // array('Email', 'email'),   
          // array('ActivationCode', 'activationcode'),         
          // array('UserName', 'usernamecheck'),


			array('Name, Phone, ActivationCode, TechSSOID, TechName, TechEmail, TechDescr, Platform, RateSurvey, CommentSurvey', 'length', 'max'=>255),
			array('SessionID, TechID, WaitingTime, WorkTime, Transmitted', 'length', 'max'=>20),
			array('createdate, ChatLog, Note, PickupTime, ClosingTime, LastActionTime,Tracking0,CField0,CField1,CField2,CField3,CField4,CField5', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, UserName, Password, Email, Name, Phone, ActivationCode, CreateDate, SessionID, TechID, TechSSOID, TechName, TechEmail, TechDescr, ChatLog, Notes, WaitingTime, PickupTime, ClosingTime, WorkTime, LastActionTime, Transmitted, Platform, StatusSurvey, RateSurvey, CommentSurvey', 'safe', 'on'=>'search'),        
        
		
            
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
           'id' => 'ID',
           'CField0'=>'CField0',           
           'CField1'=>'CField1',
           'CField2'=>'CField2',
           'CField3'=>'CField3',
           'CField4'=>'CField4',
           'CField5'=>'CField5',
		    'UserName' => 'User Name',
		    'Password' => 'Password',
			'Email' => 'Email Address',
			'Name' => 'First and Last Name',
			'Phone' => 'Phone',
			'ActivationCode' => 'Activation Code',
			'CreateDate' => 'Date',
			'SessionID' => 'Session',
			'TechID' => 'Tech',
			'TechSSOID' => 'Tech Ssoid',
			'TechName' => 'Tech Name',
			'TechEmail' => 'Tech Email',
			'TechDescr' => 'Tech Descr',
			'ChatLog' => 'Chat Log',
			'Notes' => 'Notes',
			'WaitingTime' => 'Waiting Time',
			'PickupTime' => 'Pickup Time',
			'ClosingTime' => 'Closing Time',
			'WorkTime' => 'Work Time',
			'LastActionTime' => 'Last Action Time',
			'Transmitted' => 'Transmitted',
			'platform' => 'Platform',
            'Tracking0'=>'Tracking0',
			'StatusSurvey' => 'Status',
			'RateSurvey' => 'Rate',
			'CommentSurvey' => 'Comment ',            
            
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->UserName,$this->Password);
			if(!$this->_identity->authenticate())
				$this->addError('Password','Incorrect username or password.');
		}
	}
    
   	public function activationcode($attribute,$params)
	{
		  if(isset($this->ActivationCode) && $this->ActivationCode!=='' ){
          $t = substr($this->ActivationCode,0,3);
          $check=explode(",",Yii::app()->params['checkActivationCode']);
          if(!in_array(strtoupper($t),$check))
    		$this->addError('ActivationCode','Incorrect Activation Code ');
          }  
	}

	public function usernamecheck($attribute,$params)
	{
	    if($this->ActivationCode==='' && $this->UserName===''){
	       	$this->addError('ActivationCode','Please enter:  "Activation Code" ');
            $this->addError('UserName','Please enter:  "User Name" ');
	    }
        if($this->Username!==''){
            if($this->Password===''){
             $this->addError('Password','Please enter:  "password" ');   
            }    
        }
	}
    
    
    
    
    public function getStatusSurvey($idx=0){
        $list=array(
            3=>'Solved',
            2=>'Partially Solved',
            1=>'Not Solved'
        );
           if($idx==0)
           return $list;
           else return $list[$idx];
    }
    
       public function getRateSurvey($idx=0){
        $list= array(
            4=>'Excellent',
            3=>'Good',
            2=>'Mediocre',
            1=>'Disappointing'
        );
        if($idx==0)
           return $list;
           else return $list[$idx];
        
    }
    
    public function beforeSave(){
        // map fields
        $this->Name=$this->CField0;
        $this->Email=$this->CField1;
        $this->Phone=$this->CField2;
        $this->ActivationCode=$this->CField3;
        $this->UserName=$this->CField4;
        $this->Password=$this->CField5;
        if(isset($this->PickupTime)&& $this->CreateDate==null && $this->PickupTime!=null)
        $this->CreateDate=$this->PickupTime;
        
        return parent::beforeSave();
   } 
   
    
    
    
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
        $criteria->compare('CField0',$this->CField0,true);
        $criteria->compare('CField1',$this->CField1,true);
        $criteria->compare('CField2',$this->CField2,true);
        $criteria->compare('CField3',$this->CField3,true);                
        $criteria->compare('CField4',$this->CField4,true);
        $criteria->compare('CField5',$this->CField5,true);        
        
    	$criteria->compare('UserName',$this->UserName,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('ActivationCode',$this->ActivationCode,true);
		$criteria->compare('CreateDate',$this->CreateDate,true);
		$criteria->compare('SessionID',$this->SessionID,true);
		$criteria->compare('TechID',$this->TechID,true);
		$criteria->compare('TechSSOID',$this->TechSSOID,true);
		$criteria->compare('TechName',$this->TechName,true);
		$criteria->compare('TechEmail',$this->TechEmail,true);
		$criteria->compare('TechDescr',$this->TechDescr,true);
		$criteria->compare('ChatLog',$this->ChatLog,true);
		$criteria->compare('Note',$this->Note,true);
		$criteria->compare('WaitingTime',$this->WaitingTime,true);
		$criteria->compare('PickupTime',$this->PickupTime,true);
		$criteria->compare('ClosingTime',$this->ClosingTime,true);
		$criteria->compare('WorkTime',$this->WorkTime,true);
		$criteria->compare('LastActionTime',$this->LastActionTime,true);
		$criteria->compare('Transmitted',$this->Transmitted,true);
		$criteria->compare('Platform',$this->Platform,true);
        $criteria->compare('Tracking0',$this->Tracking0,true);
        
		$criteria->compare('StatusSurvey',$this->StatusSurvey);
		$criteria->compare('RateSurvey',$this->RateSurvey,true);
		$criteria->compare('CommentSurvey',$this->CommentSurvey,true);


		return new CActiveDataProvider($this, array(
            'pagination'=>array(
            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
           ),
			'criteria'=>$criteria,
              'sort'=>array(
            'defaultOrder'=>array(
                'id'=>true,))
            
		));
	}
        
}

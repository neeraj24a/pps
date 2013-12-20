<?php

/**
 * This is the model class for table "sessionlog".
 *
 * The followings are the available columns in table 'sessionlog':
 * @property string $id
 * @property string $SessionID
 * @property string $TechID
 * @property string $TechSSOID
 * @property string $TechName
 * @property string $TechEmail
 * @property string $TechDescr
 * @property string $ChatLog
 * @property string $Note
 * @property string $WaitingTime
 * @property string $PickupTime
 * @property string $ClosingTime
 * @property string $WorkTime
 * @property string $LastActionTime
 * @property string $Transmitted
 * @property string $Platform
 * @property string $CField0
 * @property string $CField1
 * @property string $CField2
 * @property string $CField3
 * @property string $CField4
 * @property string $CField5
 * @property string $Tracking0
 */
class Sessionlog extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sessionlog the static model class
	 */
     
    public $htmlChatlog;
     
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sessionlog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SessionID, TechID, WaitingTime, WorkTime, Transmitted', 'length', 'max'=>20),
			array('TechSSOID, TechName, TechEmail, TechDescr, Platform, CField0, CField1, CField2, CField3, CField4, CField5, Tracking0', 'length', 'max'=>255),
			array('ChatLog, Note, PickupTime, ClosingTime, LastActionTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, SessionID, TechID, TechSSOID, TechName, TechEmail, TechDescr, ChatLog, Note, WaitingTime, PickupTime, ClosingTime, WorkTime, LastActionTime, Transmitted, Platform, CField0, CField1, CField2, CField3, CField4, CField5, Tracking0', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'SessionID' => 'Session',
			'TechID' => 'Tech',
			'TechSSOID' => 'Tech Ssoid',
			'TechName' => 'Tech Name',
			'TechEmail' => 'Tech Email',
			'TechDescr' => 'Tech Descr',
			'ChatLog' => 'Chat Log',
			'Note' => 'Note',
			'WaitingTime' => 'Waiting Time',
			'PickupTime' => 'Pickup Time',
			'ClosingTime' => 'Closing Time',
			'WorkTime' => 'Work Time',
			'LastActionTime' => 'Last Action Time',
			'Transmitted' => 'Transmitted',
			'Platform' => 'Platform',
            //map fields
			'CField0' => 'Full Name',
			'CField1' => 'Email',
			'CField2' => 'Phone',
			'CField3' => 'Activation Code',
			'CField4' => 'Usename',
			'CField5' => 'Password',
			'Tracking0' => 'Tracking0',
		);
	}

  public function scopes()
    {
        return array(
            'ByTech'=>array(
                'condition'=>'TechID='.Helper::getTechID(),
            ),
        );
                
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
		$criteria->compare('SessionID',$this->SessionID,true);
		$criteria->compare('TechID',$this->TechID,true);
		$criteria->compare('TechSSOID',$this->TechSSOID,true);
		$criteria->compare('TechName',$this->TechName,true);
		$criteria->compare('TechEmail',$this->TechEmail,true);
		$criteria->compare('TechDescr',$this->TechDescr,true);
		$criteria->compare('ChatLog',$this->ChatLog,true);
		$criteria->compare('Note',$this->Note,true);
		$criteria->compare('WaitingTime',$this->WaitingTime,true);
		//$criteria->compare('PickupTime',$this->PickupTime,true);
        
         if(isset($this->PickupTime) && $this->PickupTime!=null){
           $l=explode('-',$this->PickupTime);
           if(isset($l[0])){
           $this->from_date=$l[0];
           $this->from_date=str_replace("/","-",$this->from_date);
           $this->to_date=trim($this->from_date)." 00:00:00";;
           }
           if(isset($l[1]))
           {
           $this->to_date=$l[1];
           $this->to_date= str_replace("/","-",$this->to_date);
           $this->to_date=trim($this->to_date)." 23:59:59";
           }
       
        if(!empty($this->from_date) && empty($this->to_date))
        {
            $criteria->compare("PickupTime",">= $this->from_date",true);  // date is database date column field
        }elseif(!empty($this->to_date) && empty($this->from_date))
        {
           $criteria->compare("PickupTime","<= $this->to_date",true);
        }elseif(!empty($this->to_date) && !empty($this->from_date))
        {
             $criteria->compare("PickupTime",">= $this->from_date",true);
             $criteria->compare("PickupTime","<= $this->to_date",true);
        }
       }
         
         
		$criteria->compare('ClosingTime',$this->ClosingTime,true);
		$criteria->compare('WorkTime',$this->WorkTime,true);
		$criteria->compare('LastActionTime',$this->LastActionTime,true);
		$criteria->compare('Transmitted',$this->Transmitted,true);
		$criteria->compare('Platform',$this->Platform,true);
		$criteria->compare('CField0',$this->CField0,true);
		$criteria->compare('CField1',$this->CField1,true);
		$criteria->compare('CField2',$this->CField2,true);
		$criteria->compare('CField3',$this->CField3,true);
		$criteria->compare('CField4',$this->CField4,true);
		$criteria->compare('CField5',$this->CField5,true);
		$criteria->compare('Tracking0',$this->Tracking0,true);

		return new CActiveDataProvider($this, array(
           'pagination'=>array(
            'pageSize'=> Yii::app()->user->getState('pageSize',
                Yii::app()->params['defaultPageSize']),
            ),
			'criteria'=>$criteria,
            'sort'=>array(
            'defaultOrder'=>array(
                'SessionID'=>true,)
            ),
		));
	}
}
<?php

/**
 * This is the model class for table "connectlog".
 *
 * The followings are the available columns in table 'connectlog':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $name
 * @property string $phone
 * @property string $activation_code
 * @property string $ip
 * @property string $createdate
 * @property string $SessionID
 * @property string $TechID
 * @property string $TechSSOID
 * @property string $TechName
 * @property string $TechEmail
 * @property string $TechDescr
 * @property string $ChatLog
 * @property string $Notes
 * @property string $WaitingTime
 * @property string $PickupTime
 * @property string $ClosingTime
 * @property string $WorkTime
 * @property string $LastActionTime
 * @property string $transmitted
 * @property string $platform
 * @property integer $StatusSurvey
 * @property string $RateSurvey
 * @property string $CommentSurvey
 */
class test extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return test the static model class
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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('StatusSurvey', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>128),
			array('name, phone, activation_code, ip, TechSSOID, TechName, TechEmail, TechDescr, platform, RateSurvey, CommentSurvey', 'length', 'max'=>255),
			array('SessionID, TechID, WaitingTime, WorkTime, transmitted', 'length', 'max'=>20),
			array('createdate, ChatLog, Notes, PickupTime, ClosingTime, LastActionTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, name, phone, activation_code, ip, createdate, SessionID, TechID, TechSSOID, TechName, TechEmail, TechDescr, ChatLog, Notes, WaitingTime, PickupTime, ClosingTime, WorkTime, LastActionTime, transmitted, platform, StatusSurvey, RateSurvey, CommentSurvey', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'name' => 'Name',
			'phone' => 'Phone',
			'activation_code' => 'Activation Code',
			'ip' => 'Ip',
			'createdate' => 'Createdate',
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
			'transmitted' => 'Transmitted',
			'platform' => 'Platform',
			'StatusSurvey' => 'Status Survey',
			'RateSurvey' => 'Rate Survey',
			'CommentSurvey' => 'Comment Survey',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('activation_code',$this->activation_code,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('SessionID',$this->SessionID,true);
		$criteria->compare('TechID',$this->TechID,true);
		$criteria->compare('TechSSOID',$this->TechSSOID,true);
		$criteria->compare('TechName',$this->TechName,true);
		$criteria->compare('TechEmail',$this->TechEmail,true);
		$criteria->compare('TechDescr',$this->TechDescr,true);
		$criteria->compare('ChatLog',$this->ChatLog,true);
		$criteria->compare('Notes',$this->Notes,true);
		$criteria->compare('WaitingTime',$this->WaitingTime,true);
		$criteria->compare('PickupTime',$this->PickupTime,true);
		$criteria->compare('ClosingTime',$this->ClosingTime,true);
		$criteria->compare('WorkTime',$this->WorkTime,true);
		$criteria->compare('LastActionTime',$this->LastActionTime,true);
		$criteria->compare('transmitted',$this->transmitted,true);
		$criteria->compare('platform',$this->platform,true);
		$criteria->compare('StatusSurvey',$this->StatusSurvey);
		$criteria->compare('RateSurvey',$this->RateSurvey,true);
		$criteria->compare('CommentSurvey',$this->CommentSurvey,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
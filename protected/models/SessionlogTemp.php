<?php

/**
 * This is the model class for table "sessionlog_temp".
 *
 * The followings are the available columns in table 'sessionlog_temp':
 * @property string $SessionID
 * @property string $TechID
 * @property string $TechSSOID
 * @property string $TechName
 * @property string $TechEmail
 */
class SessionlogTemp extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SessionlogTemp the static model class
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
		return 'sessionlog_temp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SessionID, TechID', 'length', 'max'=>20),
			array('TechSSOID, TechName, TechEmail', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SessionID, TechID, TechSSOID, TechName, TechEmail', 'safe', 'on'=>'search'),
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
			'SessionID' => 'Session',
			'TechID' => 'Tech',
			'TechSSOID' => 'Tech Ssoid',
			'TechName' => 'Tech Name',
			'TechEmail' => 'Tech Email',
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

		$criteria->compare('SessionID',$this->SessionID,true);
		$criteria->compare('TechID',$this->TechID,true);
		$criteria->compare('TechSSOID',$this->TechSSOID,true);
		$criteria->compare('TechName',$this->TechName,true);
		$criteria->compare('TechEmail',$this->TechEmail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
<?php

/**
 * This is the model class for table "schedule_repeat".
 *
 * The followings are the available columns in table 'schedule_repeat':
 * @property integer $id
 * @property integer $user_id
 * @property string $applydate
 * @property integer $mon
 * @property integer $tue
 * @property integer $web
 * @property integer $thu
 * @property integer $fri
 * @property integer $sat
 * @property integer $sun
 * @property integer $totalweeks
 * @property integer $pause
 *
 * The followings are the available model relations:
 * @property Profiles $user
 */
class Repeat extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Repeat the static model class
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
		return 'schedule_repeat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, mon, tue, web, thu, fri, sat, sun, totalweeks, pause', 'numerical', 'integerOnly'=>true),
			array('applydate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, applydate, mon, tue, web, thu, fri, sat, sun, totalweeks, pause', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Profiles', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'applydate' => 'Start on',
			'mon' => 'Mon',
			'tue' => 'Tue',
			'web' => 'Web',
			'thu' => 'Thu',
			'fri' => 'Fri',
			'sat' => 'Sat',
			'sun' => 'Sun',
			'totalweeks' => 'Num of week',
			'pause' => 'Pause',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('applydate',$this->applydate,true);
		$criteria->compare('mon',$this->mon);
		$criteria->compare('tue',$this->tue);
		$criteria->compare('web',$this->web);
		$criteria->compare('thu',$this->thu);
		$criteria->compare('fri',$this->fri);
		$criteria->compare('sat',$this->sat);
		$criteria->compare('sun',$this->sun);
		$criteria->compare('totalweeks',$this->totalweeks);
		$criteria->compare('pause',$this->pause);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
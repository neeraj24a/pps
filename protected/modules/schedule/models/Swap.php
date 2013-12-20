<?php

/**
 * This is the model class for table "schedule_swap".
 *
 * The followings are the available columns in table 'schedule_swap':
 * @property integer $id
 * @property string $createdate
 * @property integer $scheduling_from_id
 * @property integer $scheduling_to_id
 * @property string $note
 * @property string $acceptdate
 * @property integer $user_request
 * @property integer $user_accept
 *
 * The followings are the available model relations:
 * @property ScheduleScheduling $schedulingFrom
 * @property ScheduleScheduling $schedulingTo
 */
class Swap extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Swap the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public $scheduling_from; 
    public $scheduling_to;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'schedule_swap';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createdate, scheduling_from_id, scheduling_to_id', 'required'),
			array('scheduling_from_id, scheduling_to_id, user_request, user_accept,status', 'numerical', 'integerOnly'=>true),
			array('note,username_request,username_accept', 'length', 'max'=>255),
			array('acceptdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdate, scheduling_from_id, scheduling_to_id, note, status,acceptdate, user_request, user_accept,username_request,username_accept', 'safe', 'on'=>'search'),
		);
	}


    protected function afterFind()
    {
        parent::afterFind();
        $f=Schedule::model()->findByPk($this->scheduling_from_id);
        $this->scheduling_from = "$f->username $f->date  $f->starttime->$f->endtime ";
        $f=Schedule::model()->findByPk($this->scheduling_to_id);
        $this->scheduling_to = "$f->username $f->date  $f->starttime->$f->endtime ";
        return true;
    }



    public function getStatus($idx=0){
        $list=array(
            2=>'Accept',
            1=>'Request',
            0=>'None'
        );
           if($idx==0)
           return $list;
           else return $list[$idx];
    }
    
    
    
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'schedulingFrom' => array(self::BELONGS_TO, 'ScheduleScheduling', 'scheduling_from_id'),
			'schedulingTo' => array(self::BELONGS_TO, 'ScheduleScheduling', 'scheduling_to_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'createdate' => 'Create Date',
			'scheduling_from_id' => 'From',
			'scheduling_to_id' => 'Swap To',
			'note' => 'Note',
			'acceptdate' => 'Acceptdate',
			'user_request' => 'User Request',
			'user_accept' => 'User Accept',
			'username_request' => 'User name Request',
			'username_accept' => 'User name Accept',            
            'status'=>'Status'
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
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('scheduling_from_id',$this->scheduling_from_id);
		$criteria->compare('scheduling_to_id',$this->scheduling_to_id);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('acceptdate',$this->acceptdate,true);
		$criteria->compare('user_request',$this->user_request);
		$criteria->compare('user_accept',$this->user_accept);
        $criteria->compare('username_request',$this->username_request);
        $criteria->compare('username_accept',$this->username_accept);
        $criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
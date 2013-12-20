<?php

/**
 * This is the model class for table "sm_setting".
 *
 * The followings are the available columns in table 'sm_setting':
 * @property integer $id
 * @property string $rate
 * @property string $template_id
 * @property string $autosend
 */
class SimpleMailerSetting extends CActiveRecord
{
/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return aaa the static model class
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
		return 'sm_setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('template_id, rate, autosend', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, template_id, rate, autosend', 'safe', 'on'=>'search'),
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
        'template'=>array(self::BELONGS_TO,'SimpleMailerTemplate','template_id'),
        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'template_id' => 'Template',
			'rate' => 'Rate',
			'autosend' => 'Autosend',
		);
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
        return $list[$idx];
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
		$criteria->compare('template_id',$this->template_id);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('autosend',$this->autosend);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
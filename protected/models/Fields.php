<?php

/**
 * This is the model class for table "sys_fields".
 *
 * The followings are the available columns in table 'sys_fields':
 * @property integer $id
 * @property string $modelName
 * @property string $fieldName
 * @property string $attributeLabel
 * @property integer $modified
 * @property integer $custom
 * @property string $type
 * @property integer $required
 * @property integer $readOnly
 * @property string $linkType
 */
class Fields extends BaseModel
{
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
		return 'sys_fields';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modified, custom, required, readOnly', 'numerical', 'integerOnly'=>true),
			array('modelName, fieldName, attributeLabel, linkType', 'length', 'max'=>250),
			array('type', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, modelName, fieldName, attributeLabel, modified, custom, type, required, readOnly, linkType', 'safe', 'on'=>'search'),
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
			'modelName' => 'Model Name',
			'fieldName' => 'Field Name',
			'attributeLabel' => 'Attribute Label',
			'modified' => 'Modified',
			'custom' => 'Custom',
			'type' => 'Type',
			'required' => 'Required',
			'readOnly' => 'Read Only',
			'linkType' => 'Link Type',
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
		$criteria->compare('modelName',$this->modelName,true);
		$criteria->compare('fieldName',$this->fieldName,true);
		$criteria->compare('attributeLabel',$this->attributeLabel,true);
		$criteria->compare('modified',$this->modified);
		$criteria->compare('custom',$this->custom);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('required',$this->required);
		$criteria->compare('readOnly',$this->readOnly);
		$criteria->compare('linkType',$this->linkType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
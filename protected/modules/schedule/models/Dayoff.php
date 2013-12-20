<?php

class Dayoff extends BaseModel
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Scheduling the static model class
     */

    public $scheduledate;

    public function getListTime()
    {
        $time = array();
        for ($i = 1; $i <= 24; $i++)
        {
            for ($j = 0; $j < 60; $j += 15)
            {
                if ($i < 10)
                    $ii = "0" . "$i";
                else
                    $ii = $i;
                if ($j < 10)
                    $jj = "0" . "$j";
                else
                    $jj = $j;
                $time["$ii:$jj"] = "$ii:$jj";
            }
        }
        return $time;
    }

    
    public static function model($className = __class__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'schedule_dayoff';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(array('user_id, fromdate, todate,starttime, endtime', 'required'), 
            array('user_id, approved,type', 'numerical', 'integerOnly' => true), 
            array('username, note','length', 'max' => 255),
            array('id, user_id, username, note, fromdate,todate, starttime, endtime,approved,type','safe', 'on' => 'search'));
    }
    
    public function getStatus(){
        return array(1=>'Yes',0=>'No');
    }

  public function scopes()
    {
        return array(
            'ByTech'=>array(
                'condition'=>'user_id='.Helper::getUserID(),
            ),
        );
                
    }
    

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('user' => array(self::BELONGS_TO, 'user', 'id')); 
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
           'id' => 'ID', 
           'user_id' => 'User name ', 
           'username' => 'User name',
            'note' => 'Note', 
            'fromdate' => 'From Date', 
            'todate' => 'To Date',
            'starttime' => 'Start Time', 
            'endtime' =>'End Time', 
            'type' => 'Type', 
            'approved' => 'Approved', 
           ); 
    }
    

    protected function afterFind()
    {
        parent::afterFind();
        if (isset($this->starttime))
            $this->starttime = substr($this->starttime, 0, 5);
        if (isset($this->endtime))
            $this->endtime = substr($this->endtime, 0, 5);
        return true;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('fromdate', $this->fromdate, true);
        $criteria->compare('todate', $this->todate, true);        
        $criteria->compare('starttime', $this->starttime, true);
        $criteria->compare('endtime', $this->endtime, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('approved', $this->approved);

        return new CActiveDataProvider($this, array(
             'pagination'=>array(
             'pageSize'=> Yii::app()->user->getState('pageSize',
                Yii::app()->params['defaultPageSize']),
            ),
            'criteria' => $criteria,
            'sort'=>array(
            'defaultOrder'=>array(
                'id'=>true,)
            ),
             ));
    }
}

<?php

/**
 * This is the model class for table "schedule_scheduling".
 *
 * The followings are the available columns in table 'schedule_scheduling':
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property string $note
 * @property string $date
 * @property string $starttime
 * @property string $endtime
 * @property integer $repeat
 * @property integer $status
 * @property integer $calloff
 * @property string $notecalloff
 * @property integer $acceptcalloff
 * @property integer $swap_id
 *
 * The followings are the available model relations:
 * @property Profiles $user
 * @property ScheduleSwap[] $scheduleSwaps
 * @property ScheduleSwap[] $scheduleSwaps1
 */
class Schedule extends BaseModel
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



    public function getColorEvent()
    {
        $colorevent = "";
        if ($this->dayoff == 1)
        $colorevent = '#666';
        return $colorevent;
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
        return 'schedule_scheduling';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(array('user_id, date, starttime, endtime', 'required'), 
            array('user_id, repeat, status, swap_id,mon, tue, wed, thu, fri, sat, sun, totalweeks, pause,parent_id',
            'numerical', 'integerOnly' => true), 
            array('username, note ',
            'length', 'max' => 255), array('applydate', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
        array('id, user_id, username, note, date, starttime, endtime, repeat, repeat_id,status,   dayoff, noteaccept,swap_id,applydate, mon, tue, wed, thu, fri, sat, sun, totalweeks, pause,parent_id',
            'safe', 'on' => 'search'), );
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
        return array('user' => array(self::BELONGS_TO, 'user', 'id'), 'scheduleSwaps' =>
            array(self::HAS_MANY, 'ScheduleSwap', 'scheduling_from_id'), 'scheduleSwaps1' =>
            array(self::HAS_MANY, 'ScheduleSwap', 'scheduling_to_id'), );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('id' => 'ID', 'user_id' => 'User name ', 'username' => 'User name',
            'note' => 'Note', 'date' => 'Date', 'starttime' => 'Start Time', 'endtime' =>
            'End Time', 'repeat' => 'Repeat', 'status' => 'Status', 
            'dayoff' =>'Day off', 'swap_id' => 'Swap', 'applydate' => 'Start on', 'mon' => 'Mon',
            'tue' => 'Tue', 'wed' => 'wed', 'thu' => 'Thu', 'fri' => 'Fri', 'sat' => 'Sat',
            'sun' => 'Sun', 'totalweeks' => 'Num of week', 'pause' => 'Pause', 'parent_id' =>
            "parent_id");
    }

    private function checkday($s, $d)
    {
        $re = false;
        $list = array("mon", "tue", "wed", "thu", "fri", "sat", "sun");
        foreach ($list as $item)
        {
            if ($s->$item == 1 && $item == strtolower($d))
                $re = true;
        }
        return $re;
    }

    public function repeatSchedule()
    {
        if ($this->repeat != 1)
            return;
        for ($i = 0; $i < $this->totalweeks * 7; $i++)
        {
            $onStart = date('Y-m-d', strtotime("+$i day", strtotime($this->applydate)));
            if ($this->checkday($this, date("D", strtotime($onStart))))
            {
                $n = new Schedule();
                $n->attributes = $this->attributes;
                $n->id = null;
                $n->parent_id = $this->id;
                $n->date = $onStart;
                $this->repeat=0;
                $n->deleteDuplicate($this->user_id,$n->date);
                $n->save(false);
            }
        }
    }
    
    public  function deleteDuplicate($userid,$date){
       $m=Schedule::model()->find("user_id=$userid and date='$date'");
       if(isset($m)) $m->delete(); 
    }

    public function getEvent()
    {
        return array('id' => $this->id, 'title' => ($this->dayoff == 1) ? $this->
            username . " (off)" : $this->username, 
            //'description' => $this->starttime . '->' .$this->endtime, 
            'description' => '',
            'start' => date('Y-m-d H:i', strtotime("$this->date $this->starttime")),
            'end' => date('Y-m-d H:i', strtotime("$this->date $this->endtime")), 'allDay' => false,
            'color' => $this->getColorEvent());
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

    protected function afterSave()
    {
        parent::afterSave();
        if ($this->parent_id > 0)
            return;
        $this->repeatSchedule();
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
        $criteria->compare('date', $this->date, true);
        $criteria->compare('starttime', $this->starttime, true);
        $criteria->compare('endtime', $this->endtime, true);
        $criteria->compare('repeat', $this->repeat);
        $criteria->compare('status', $this->status);
        $criteria->compare('dayoff', $this->dayoff);
        $criteria->compare('swap_id', $this->swap_id);
        $criteria->compare('applydate', $this->applydate, true);
        $criteria->compare('mon', $this->mon);
        $criteria->compare('tue', $this->tue);
        $criteria->compare('wed', $this->wed);
        $criteria->compare('thu', $this->thu);
        $criteria->compare('fri', $this->fri);
        $criteria->compare('sat', $this->sat);
        $criteria->compare('sun', $this->sun);
        $criteria->compare('totalweeks', $this->totalweeks);
        $criteria->compare('pause', $this->pause);
        $criteria->compare('parent_id', $this->parent_id);

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

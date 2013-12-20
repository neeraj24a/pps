<?php

/**
 * This is the model class for table "survey".
 *
 * The followings are the available columns in table 'survey':
 * @property string $id
 * @property string $Name
 * @property string $Email
 * @property string $Phone
 * @property string $Comment
 * @property integer $Status
 * @property integer $Rate
 * @property string $UserName
 * @property string $Password
 * @property string $ActivationCode
 * @property string $create_date
 * @property string $SessionID
 */
class Survey extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Survey the static model class
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
		return 'survey';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Status, Rate', 'numerical', 'integerOnly'=>true),
			array('Name, Phone, ActivationCode', 'length', 'max'=>255),
			array('Email, UserName, Password', 'length', 'max'=>128),
			array('SessionID', 'length', 'max'=>20),
			array('Comment, CreateDate,CField0,CField1,CField2,CField3,CField4,CField5,TechID,TechName,TechEmail', 'safe'),
            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, Name, Email, Phone, Comment, Status, Rate, UserName, Password, ActivationCode, CreateDate, SessionID,TechID,TechName,TechEmail,SentEmail', 'safe', 'on'=>'search'),
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
    
        
     public function getRateSurveyFull($idx=0){
        $list= array(
            4=>'Excellent',
            3=>'Good',
            2=>'Mediocre',
            1=>'Disappointing',
           -1=>'Disappointing-Modified',
           -2=>'Mediocre-Modified',            
           -3=>'Good-Modified',            
           -4=>'Excellent-Modified',            
            );
        if($idx==0)
             return $list;
        else return $list[$idx];
    }
    
       public function getRateSurvey($idx=0,$op=true){
        $list= array(
            4=>'Excellent',
            3=>'Good',
            2=>'Mediocre',
            1=>'Disappointing'
        );
        
        $list_m= array(
            1=>'Disappointing',        
           -1=>'Disappointing-Modified',
           -2=>'Mediocre-Modified',            
           -3=>'Good-Modified',            
           -4=>'Excellent-Modified',            
        );        
        
        if($idx==0)
            if($op)
             return $list;
            else  return $list_m;
        else 
        
        return $list[$idx];
    }


    public function showEmail(){
        if($this->SentEmail)
        return '<span class="icon-envelope"></span>'." ".$this->Email;
        else return $this->Email;
    }
    

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Name' => 'First and Last Name ',
			'Email' => 'Email',
			'Phone' => 'Phone',
			'Comment' => 'Comment',
			'Status' => 'Status',
			'Rate' => 'Rate',
			'UserName' => 'User Name',
			'Password' => 'Password',
			'ActivationCode' => 'Activation Code',
			'CreateDate' => 'Create Date',
			'SessionID' => 'Session',
            'TechID' => 'Tech',
			'TechName' => 'Tech Name',
			'TechEmail' => 'Tech Email',
            'CField0' => 'Cfield0',
			'CField1' => 'Cfield1',
			'CField2' => 'Cfield2',
			'CField3' => 'Cfield3',
			'CField4' => 'Cfield4',
			'CField5' => 'Cfield5',
            'SentEmail' => 'SentEmail'
		);
	}
    
    

        
    
  public function beforeSave(){
        // map fields
        $this->Name=$this->CField0;
        $this->Email=$this->CField1;
        $this->Phone=$this->CField2;
        $this->ActivationCode=$this->CField3;
        $this->UserName=$this->CField4;
        $this->Password=$this->CField5;
        return parent::beforeSave();
   } 
   
  
   


 protected function afterFind (){
      parent::afterFind();
      if(!isset($this->TechName) || ($this->TechName===''))
      {
        $s=  Sessionlog::model()->find("SessionID=$this->SessionID");
        if(isset($s)){
        $this->TechName= $s->TechName;
        $this->TechID= $s->TechID;
        $this->TechEmail= $s->TechEmail;
        $this->save(false);
        }
      }
	}
    
  public function scopes()
    {
        return array(
            'qc'=>array(
                'condition'=>'Rate<=1',
            ),
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('Comment',$this->Comment,true);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('Rate',$this->Rate);
		$criteria->compare('UserName',$this->UserName,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('ActivationCode',$this->ActivationCode,true);
        
        
       if(isset($this->CreateDate) && $this->CreateDate!=null){
           $l=explode('-',$this->CreateDate);
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
            $criteria->compare("CreateDate",">= $this->from_date",true);  // date is database date column field
        }elseif(!empty($this->to_date) && empty($this->from_date))
        {
           $criteria->compare("CreateDate","<= $this->to_date",true);
        }elseif(!empty($this->to_date) && !empty($this->from_date))
        {
             $criteria->compare("CreateDate",">= $this->from_date",true);
             $criteria->compare("CreateDate","<= $this->to_date",true);
        }
        
         }
         
        
		$criteria->compare('SessionID',$this->SessionID,true);
        $criteria->compare('TechID',$this->TechID,true);
        $criteria->compare('TechName',$this->TechName,true);        
        $criteria->compare('TechEmail',$this->TechEmail,true);        

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
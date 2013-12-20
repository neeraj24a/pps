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

 * @property integer $IsOld

 * @property string $CreateDate

 

 */

class Customerlog extends BaseModel

{

	/**

	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Survey the static model class
	 */
     
     public $status_text;
     public $rate_text;

	public static function model($className=__CLASS__)

	{

		return parent::model($className);

	}



	/**

	 * @return string the associated database table name

	 */

	public function tableName()

	{

		return 'customerlog';

	}



	/**

	 * @return array validation rules for model attributes.

	 */

	public function rules()

	{

		// NOTE: you should only define rules for those attributes that

		// will receive user inputs.

		return array(

			array('Status', 'numerical', 'integerOnly'=>true),
			array('Name, Phone','length', 'max'=>255),
			array('Email', 'length', 'max'=>128),
			array('Comment, CreateDate,Rate', 'safe'),

			// The following rule is used by search().

			// Please remove those attributes that should not be searched.

			array('id, Name, Email, Phone, Comment, Status, CreateDate, Rate', 'safe', 'on'=>'search'),

		);

	}





	/**

	 * @return array relational rules.

	 */

	public function relations()

	{

		// NOTE: you may need to adjust the relation name and the related

		// class name for the relations automatically generated below.

		return array();

	}

    

     

    public function getStatus($idx=null){

        $list=array(
            3=>'Potential',
            2=>'Denied',        
            1=>'Upsold',
            0=>'Not Called'

        );

           if($idx==null)

           return $list;

           else return $list[$idx];

    }


       public function getRate($idx=null){
        $list= array(
            4=>'Excellent',
            3=>'Good',
        );
        if($idx==null)
           return $list;
           else return $list[$idx];
        
    }
    
    
    
    
	 protected function afterFind (){
       $this->status_text= $this->getStatus($this->Status);
       $this->rate_text= $this->getRate($this->Rate);
        parent::afterFind();
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
			'CreateDate' => 'Create Date',
            'Rate' => 'Rate',

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
        $criteria->compare('Rate',$this->Rate);
		$criteria->compare('Status',$this->Status);
		//$criteria->compare('CreateDate',$this->CreateDate,true);
        
        
        
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
        
		return new CActiveDataProvider($this, array(
           'pagination'=>array(
            'pageSize'=> Yii::app()->user->getState('pageSize',
                Yii::app()->params['defaultPageSize']),
            ),
			'criteria'=>$criteria,
            'sort'=>array(
            'defaultOrder'=>array(
                'id'=>true)
        ),
		));
	}
}
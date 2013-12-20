<?php

class BaseModel extends CActiveRecord
{


public $from_date;
public $to_date;    

 public function setAttributes($values,$safeOnly=true) {
    if(!is_array($values)) return;
    $attributes=array_flip($safeOnly ? $this->getSafeAttributeNames() : $this->attributeNames());
    foreach($values as $name=>$value) {
      if(isset($attributes[$name])) {
        $column = $this->getTableSchema()->getColumn($name); // new
        if (stripos($column->dbType, 'decimal') !== false) // new
          $value = Yii::app()->format->unformatNumber($value); // new
        $this->$name=$value;
      }
      else if($safeOnly)
        $this->onUnsafeAttribute($name,$value);
    }
  }
      
   

    /**
     * @return string the route to view this model
     */
    public function getDefaultRoute()
    {
        return strtolower(get_class($this)); // assume the model name is the same as the controller
    }

    /**
     * @return string the route to this model's AutoComplete data source
     */
    public function getAutoCompleteSource()
    {
        return '/' . strtolower(get_class($this)) . '/getItems'; // assume the model name is the same as the controller
    }

  


    /**
     * Base search function, includes Retrieves a list of models based on the current search/filter conditions.
     * @param CDbCriteria $criteria the attribute name
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchBase($criteria)
    {

        $this->queryFields();

        $this->compareAttributes($criteria);

        return new SmartDataProvider(get_class($this), array('sort' => array('defaultOrder' =>
            'id DESC', ), 'pagination' => array('pageSize' => ProfileChild::
            getResultsPerPage(), ), 'criteria' => $criteria, ));
    }

        


    public function createLink()
    {
        if (isset($this->id))
        if (isset($this->name))
            return CHtml::link($this->name, array($this->getDefaultRoute().'/view&id=' . $this->id));
        if (isset($this->num))
            return CHtml::link($this->num, array($this->getDefaultRoute().'/view&id=' . $this->id));
        if (isset($this->fullname))
            return CHtml::link($this->fullname, array($this->getDefaultRoute().'/view&id=' . $this->id));            
        if (isset($this->subject))
            return CHtml::link($this->subject, array($this->getDefaultRoute().'/view&id=' . $this->id));            
            
        return '';    
    }
    
     public function updateLink()
    {
           if (isset($this->id))
        if (isset($this->name))
            return CHtml::link($this->name, array($this->getDefaultRoute().'/update&id=' . $this->id));
        if (isset($this->num))
            return CHtml::link($this->num, array($this->getDefaultRoute().'/update&id=' . $this->id));
        if (isset($this->fullname))
            return CHtml::link($this->fullname, array($this->getDefaultRoute().'/update&id=' . $this->id));
            
        return '';
    }
    
    public function getBranchName()
    {
        if ($this->hasAttribute('branch_id'))
        return Branch::model()->findbyPk($this->branch_id)->name;
        else
            return '';
    }
    
    
    public function init(){
    if ($this->hasAttribute('create_uid'))
        $this->create_uid=$this->create_uid==null?Yii::app()->user->id:$this->create_uid;
    }
    
    public function getCreateName()
    {
        if ($this->hasAttribute('create_uid')){
         $u=User::model()->findbyPk($this->create_uid);
         if(isset($u))
            return User::model()->findbyPk($this->create_uid)->username;
         else return "";   
        }
        else
            return '';
    }
    

    
    public function getUpdateName()
    {
        
        if ($this->hasAttribute('update_uid'))
        return User::model()->findbyPk($this->update_uid)->username; 
        else
             return '';
    }    
    
    
    public function beforeValidate(){
        if ($this->hasAttribute('branch_id')&& $this->branch_id==null)
        {
            $user = Yii::app()->getModule('user')->user(Yii::app()->user->id);
            $this->branch_id = $user->branch_id;
        } 
      return parent::beforeValidate();  
    }
    
    
    public function beforeSave()
    {
                if ($this->isNewRecord)
                {
                    if ($this->hasAttribute('create_uid'))
                        $this->create_uid = Yii::app()->user->id;
                    if ($this->hasAttribute('create_date'))
                        $this->create_date=Yii::app()->dateFormatter->formatDateTime(time(), 'medium', 'medium'); 
                        
                } 
            if ($this->hasAttribute('update_uid')){
                $this->update_uid = Yii::app()->user->id;
                }
                
            if ($this->hasAttribute('update_date')){
                $this->update_date= Yii::app()->dateFormatter->formatDateTime(time(), 'medium', 'medium');                                           
                } 
                

      return parent::beforeSave();
    }
    public function behaviors()
    {
        return array(
               //'DateTimeI18NBehavior'=>array('class' => 'ext.DateTimeI18NBehavior.DateTimeI18NBehavior',),                
              // 'activerecord-relation'=>array('class'=>'ext.yiiext.EActiveRecordRelationBehavior',),
   
  	);
               
   }       
}

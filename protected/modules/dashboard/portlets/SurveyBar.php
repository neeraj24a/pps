<?php
class SurveyBar extends DPortlet
{
 public $comp=""  ; 
  protected function renderContent()
  {
    $dr= new  DateRange();
    $dr->DataR =  date('Y/m/1',strtotime("-3 months"))."-".date('Y/m/d',time());
    if(isset($_POST['DateRange']))
    $dr->DataR=$_POST['DateRange']['DataR'];
    $chartdata=array('survey'=>$this->getDataSurvey($dr->DataR));
    $this->render("SurveyBar",array('chartdata'=>$chartdata,'dr'=>$dr));
  }
  
  protected function getTitle()
  {
    return 'Surveys for comparison';
  }
  
  protected function getClassName()
  {
    return __CLASS__;
  }
  
     
private function getDataSurvey($dr,$techid=0){
            $filter="";
            if($techid>0)
            $filter=" and TechID=$techid";
            if($dr==''){
            $f=date('Y/m/d',time());
            $t=date('Y/m/d',time());               
            } else   {
            $ar=explode('-',$dr);
            $f=$ar[0];
            $t=$ar[1];
            }
             $g="";
            if(date("Y/m",strtotime($f))==date("Y/m",strtotime($t))){
            $g=" (WEEK(createdate,5) - WEEK(DATE_SUB(createdate, INTERVAL DAYOFMONTH(createdate)-1 DAY),5)+1)";
            $this->comp="weeks";
            }
            else  if(date("Y",strtotime($f))==date("Y",strtotime($t))){ 
            $g=" DATE_FORMAT(createdate,'%m') ";
            $this->comp="months";
            }
            else { 
                $g=" DATE_FORMAT(createdate,'%Y') ";
                $this->comp="years";
            }
            
            
            $sql = " SELECT $g as mName, Rate , count(id) as Count  from survey  "; 
            $sql .= " WHERE Rate>0 and not TechName is null and  CreateDate >='$f 00:00:01' and CreateDate <='$t 23:59:59' ". $filter;
            $sql .= " GROUP BY  $g , Rate ";
            
            $command = Yii::app()->db->createCommand($sql);
            $results = $command->queryAll();
            return $results;
     }    
}

 
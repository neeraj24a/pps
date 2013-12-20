<?php
class SurveysOfTech extends DPortlet
{

  protected function renderContent()
  {
    $dr= new  DateRange();
    $dr->DataR =  date('Y/m/d',strtotime("-7day"))."-".date('Y/m/d',time());
    if(isset($_POST['DateRange']))
    $dr->DataR=$_POST['DateRange']['DataR'];
    $tid=Helper::getTechID();
    $chartdata=$this->getData($dr->DataR,$tid);
    $this->render("SurveyChart",array('chartdata'=>$chartdata,'dr'=>$dr));
  }
  
  protected function getTitle()
  {
    return 'Surveys of '. Yii::app()->user->name ;
  }
  
  protected function getClassName()
  {
    return __CLASS__;
  }
  
   private function getData($dr,$techid=0){
            $filter="";
            if($techid>0)
            $filter=" and TechID=$techid";
            $ar=explode('-',$dr);
            $f=$ar[0];
            $t=$ar[1];
            $sql = "  SELECT Rate , count(id) Count  from survey s "; 
            $sql .= " WHERE s.Rate>0 and s.CreateDate >='$f 00:00:01' and s.CreateDate <='$t 23:59:59' ". $filter;
            $sql .= " GROUP BY s.rate";
            $command = Yii::app()->db->createCommand($sql);
            $results = $command->queryAll();
            return $results;
     }
    
}
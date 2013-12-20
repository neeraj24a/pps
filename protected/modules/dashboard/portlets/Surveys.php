<?php
class Surveys extends DPortlet
{

  protected function renderContent()
  {
    
    $dr= new  DateRange();
    $dr->DataR =  date('Y/m/d',strtotime("-7day"))."-".date('Y/m/d',time());
    if(isset($_POST['DateRange']))
    $dr->DataR=$_POST['DateRange']['DataR'];
    
    $chartdata=$this->getData($dr->DataR);
    $this->render("SurveyChart",array('chartdata'=>$chartdata,'dr'=>$dr));
  }
  
  protected function getTitle()
  {
    return 'Surveys';
  }
  
  protected function getClassName()
  {
    return __CLASS__;
  }
  
   private function getData($dr,$techid=0){

            $filter="";
            if($techid>0)
            $filter=" and TechID=$techid";
            if($dr==''){
            $f=date('Y/m/d',time());
            $t=date('Y/m/d',time());               
            } else 
            {
            $ar=explode('-',$dr);
            $f=$ar[0];
            $t=$ar[1];
            }
            
            $sql = "  SELECT Rate , count(id) Count  from survey s "; 
            $sql .= " WHERE s.Rate>0 and not TechName is null and  s.CreateDate >='$f 00:00:01' and s.CreateDate <='$t 23:59:59' ". $filter;
            $sql .= " GROUP BY s.rate";
            $command = Yii::app()->db->createCommand($sql);
            $results = $command->queryAll();
            return $results;
     }
    
}
<?php
class Sessions extends DPortlet
{

  protected function renderContent()
  {
    $dr= new  DateRange();
    $dr->DataR =  date('Y/m/d',strtotime("-7day"))."-".date('Y/m/d',time());
    if(isset($_POST['DateRange']))
    $dr->DataR=$_POST['DateRange']['DataR'];
    
    $chartdata=$this->getData($dr->DataR);
    $this->render("SessionChart",array('chartdata'=>$chartdata,'dr'=>$dr));
  }
  
  protected function getTitle()
  {
    return 'Sessions';
  }
  
  protected function getClassName()
  {
    return __CLASS__;
  }
  
    private function getData($dr){
            $ar=explode('-',$dr);
            $f=$ar[0];
            $t=$ar[1];
            $sql = "  SELECT TechName , count(id) Count  from sessionlog s "; 
            $sql .= " WHERE  s.ClosingTime >='$f 00:00:01' and s.ClosingTime <='$t 23:59:59'";
            $sql .= " GROUP BY s.TechName";
            $command = Yii::app()->db->createCommand($sql);
            $results = $command->queryAll();
            return $results;
     }
       
}
<?php
class SessionChartMonth extends DPortlet
{

 public $comp=""  ; 
  protected function renderContent()
  {
    $dr= new  DateRange();
    $dr->DataR =  date('Y/m/1',strtotime("-3 months"))."-".date('Y/m/d',time());
    if(isset($_POST['DateRange']))
    $dr->DataR=$_POST['DateRange']['DataR'];
    
    $chartdata=array('sessions'=>$this->getData($dr->DataR),'survey'=>$this->getDataSurvey($dr->DataR));
    $this->getTitle();
    $this->render("SessionChartMonth",array('chartdata'=>$chartdata,'dr'=>$dr));
    
  }
  
  protected function getTitle()
  {
    return "Sessions for comparison";
  }
  
  protected function getClassName()
  {
    return __CLASS__;
  }
  
private function getData($dr){
            $ar=explode('-',$dr);
            $f=$ar[0];
            $t=$ar[1];
            
            if(date("Y/m",strtotime($f))==date("Y/m",strtotime($t))){
            $g=" (WEEK(ClosingTime,5) - WEEK(DATE_SUB(ClosingTime, INTERVAL DAYOFMONTH(ClosingTime)-1 DAY),5)+1)";
            $this->comp="weeks";
            }
            else  if(date("Y",strtotime($f))==date("Y",strtotime($t))){ 
            $g=" DATE_FORMAT(ClosingTime,'%m') ";
            $this->comp="months";
            }
            else { 
                $g=" DATE_FORMAT(ClosingTime,'%Y') ";
                $this->comp="years";
            }
            
            $sql = " SELECT $g as mName , COUNT(*) as Count  from sessionlog  "; 
            $sql .= " WHERE  ClosingTime >='$f 00:00:01' and ClosingTime <='$t 23:59:59'";
            $sql .= " GROUP BY $g ";
            $command = Yii::app()->db->createCommand($sql);
         
         /*   
            $sql = " SELECT  ClosingTime, year(ClosingTime) y, month(ClosingTime) m, 
                    (WEEK(ClosingTime,5) - WEEK(DATE_SUB(ClosingTime, INTERVAL DAYOFMONTH(ClosingTime)-1 DAY),5)+1) w 
                      from sessionlog
                      WHERE  ClosingTime >='$f 00:00:01' and ClosingTime <='$t 23:59:59'
                    ORDER BY ClosingTime"; 
            $command = Yii::app()->db->createCommand($sql);
           */ 
                        
            $results = $command->queryAll();
            return $results;
     }
     
private function getDataSurvey($dr,$techid=0){
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
            
            $sql = ' SELECT DATE_FORMAT(s.createdate,"%Y/%m") as mName, Rate , count(id) as Count  from survey s '; 
            $sql .= " WHERE s.Rate>0 and s.CreateDate >='$f 00:00:01' and s.CreateDate <='$t 23:59:59' ". $filter;
            $sql .= ' GROUP BY DATE_FORMAT(s.createdate,"%Y/%m"), s.rate ';
            $command = Yii::app()->db->createCommand($sql);
            $results = $command->queryAll();
            return $results;
     }    
}

 
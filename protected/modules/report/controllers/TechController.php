<?php

class TechController extends Controller
{
	public function actionIndex()
	{
        $dr= new  DateRange();
        $dr->DataR =  date('Y/m/d',strtotime("-30day"))."-".date('Y/m/d',time());
        if(isset($_POST['DateRange']))
        $dr->DataR=$_POST['DateRange']['DataR'];
    
       $m=$this->getData($dr->DataR);
       print_r($dr->DataR,true);
       
		$this->render('index', array("model"=>$m,'dr'=>$dr));
	}


 private function getData($dr,$techid=0){

           $filter="";
            if($techid>0)
            $filter=" and s.TechID=$techid";
            if($dr==''){
            $f=date('Y/m/d',time());
            $t=date('Y/m/d',time());               
            } else 
            {
            $ar=explode('-',$dr);
            $f=$ar[0];
            $t=$ar[1];
            }
            $sql= " select  s.TechName , ";
            $sql .="  count(s.Rate) as Total, ";
            $sql .=" sum(if( s.Rate=4 ,1,0)) Excellent ,";
            $sql .=" sum(if( s.Rate=3 ,1,0)) Good ,";
            $sql .=" sum(if( s.Rate=2 ,1,0)) Mediocre ,";
            $sql .=" sum(if( s.Rate=1 ,1,0)) Disappointing ";
            $sql .=" from survey s ";
            $sql .= " WHERE s.Rate>0 and not TechName is null and  s.CreateDate >='$f 00:00:01' and s.CreateDate <='$t 23:59:59' ". $filter;
            $sql .=" Group by s.TechName";
            $command = Yii::app()->db->createCommand($sql);
            $results = $command->queryAll();
            return $results;
     }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
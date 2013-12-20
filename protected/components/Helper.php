<?php
	
class Helper {
  public static function getTechID(){
     $user = Yii::app()->getModule('user')->user();
     if(Yii::app()->user->isAdmin())
     return 0;
     else 
     return $user->tech_id;
  }
  
  public static function getUserID(){
     $user = Yii::app()->getModule('user')->user();
     return $user->id;
  }  
  
  public static function getCurrUser(){
     return Yii::app()->getModule('user')->user();
  }
  
    public static function isAdmin(){
     return Yii::app()->getModule('user')->isAdmin();
  }
  
   public static function getRangeDate(){
        $ar = array();
        $ar['t']['f']= date("Y/m/d", time());
        $ar['t']['t']= date("Y/m/d", time());
        
        $ar['y']['f']= date("Y/m/d",strtotime('-1 day'));
        $ar['y']['t']=  date("Y/m/d",strtotime('-1 day'));

        $ar['cw']['f']= date("Y/m/d",strtotime('last Monday'));
        $ar['cw']['t']=  date('Y/m/d',time()) ;
        
        $ar['cm']['f']= date("Y/m/1",time());
        $ar['cm']['t']=  date('Y/m/d',time());

        $ar['lw']['f']=   date("Y/m/d",strtotime('last Sunday') - 6*24*3600);
        $ar['lw']['t']=  date('Y/m/d',strtotime('last Sunday'));
        
        
        $ar['lm']['f']=   date("Y/m/1",strtotime("-1 month"));
        $ar['lm']['t']=  date("Y/m/t",strtotime("-1 month"));
        return $ar;
  }  
public static function weekNumber($date)
{
    return idate(W, strtotime($date));
}
public static function viewCharType($f,$t){
        if(date("Y/m",strtotime($f))==date("Y/m",strtotime($t)))
           return "weeks";
         else  if(date("Y",strtotime($f))==date("Y",strtotime($t))) 
         return "months";
         else  
         return "years";
    }
}
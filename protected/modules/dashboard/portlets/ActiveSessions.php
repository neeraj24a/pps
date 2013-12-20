<?php
class ActiveSessions extends DPortlet
{

  protected function renderContent()
  {
    $this->render("ActiveSessions",array('data'=>$this->getdata()));
  }
  
  protected function getTitle()
  {
    return 'Active sessions for channel: "Premier PC Support"';
  }
  
  protected function getClassName()
  {
    return __CLASS__;
  }
  
  
   private function getdata(){
      
        $getSession_V3=array(
            'iNodeID'=>Yii::app()->params['logmein_pps_iNodeID'],
            'eNodeRef'=>'CHANNEL'
        );
        
       $this->initWS(); 
       $data= $this::$ws->getSession_V3($getSession_V3);
       if(is_object($data->aSessions->SESSION_V3))
       $fixData[]=$data->aSessions->SESSION_V3;
       else $fixData =$data->aSessions->SESSION_V3;
  
       if(isset($fixdata) && count($fixdata)>0){
        $session['getHierarchy_Active_sessions']=serialize($fixdata);
        } else  
        if (isset($session['getHierarchy_Active_sessions'])){
           $fixdata = unserialize($session['getHierarchy_Active_sessions']);
         } else $fixdata=array();
       
        $dp=new CArrayDataProvider($fixData,array(
        'keyField'=>false,
        'pagination' => false,
        ));
     return $dp;
  }
}
<?php
class UsersOnline extends DPortlet
{
  protected function renderContent()
  {
    $data=$this->getdata();
    $this->render("UsersOnline",array('data'=>$data));
  }
  
  protected function getTitle()
  {
    return 'Users signed into LogMein';
  }
  
  protected function getClassName()
  {
    return __CLASS__;
  }
  
  
   private function getdata(){
    
      $session = new CHttpSession;
      $session->open();
      static $data=null;
       $this->initWS(); 
        $getHierarchy=array(
        "" => "",
        );
        $data= $this::$ws->getHierarchy_v2($getHierarchy);


      if(isset($data))
      if(isset($data->aHierarchy->HIERARCHY) and is_object($data->aHierarchy))
        foreach ($data->aHierarchy->HIERARCHY as  $item){
            if($item->eStatus=='Online' or $item->eStatus=='Away')
            $fixdata[$item->iNodeID]=$item;
        }
        if(isset($fixdata) && count($fixdata)>0){
        $session['getHierarchy']=serialize($fixdata);
        } else  
        if (isset($session['getHierarchy'])){
           $fixdata = unserialize($session['getHierarchy']);
         } else $fixdata=array();
     return $fixdata;
  }
}
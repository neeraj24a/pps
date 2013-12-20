<?php
$linkCalendar ='/schedule/schedule/index';
$Calendar="Calendar";
$Scheduling="Scheduling";
$swapshifts="Shift Swaps";
if(!Helper::isAdmin()){
 $Calendar= "My Calendar";
 $Scheduling="My Scheduling";
 $swapshifts="My Shift Swaps";   
}

$this->menuMain=array(
array(
'class'=>'bootstrap.widgets.TbMenu',
'items'=>array(
        array('label'=>'Dashboard', 'url'=>array('/dashboard')),
        array('label'=>'Surveys', 'url'=>'/survey/list', 'items'=>array(
            array('label'=>'Today', 'url'=>array('/survey/list?sort=t')),
            array('label'=>'Yesterday', 'url'=>array('/survey/list?sort=y')),
            array('label'=>'Current week', 'url'=>array('/survey/list?sort=cw')),
            array('label'=>'Current month', 'url'=>array('/survey/list?sort=cm')),
            array('label'=>'Last week', 'url'=>array('/survey/list?sort=w')),
            array('label'=>'Last month', 'url'=>array('/survey/list?sort=m')),
            array('label'=>'All time', 'url'=>array('/survey/list?sort=e')),
            )),
      //  array('label'=>'Sales', 'url'=>array('/sale/index')),
        array('label'=>'Sales', 'url'=>'#', 'items'=>array(
            array('label'=>'Today', 'url'=>array('/sale/index?sort=t')),
            array('label'=>'Yesterday', 'url'=>array('/sale/index?sort=y')),
            array('label'=>'Current week', 'url'=>array('/sale/index?sort=cw')),
            array('label'=>'Current month', 'url'=>array('/sale/index?sort=cm')),
            array('label'=>'Last week', 'url'=>array('/sale/index?sort=w')),
            array('label'=>'Last month', 'url'=>array('/sale/index?sort=m')),
            array('label'=>'All time', 'url'=>array('/sale/index?sort=e')),
            )),
        //array('label'=>'Sessions', 'url'=>array('/session/index')),
        array('label'=>'Sessions', 'url'=>'#', 'items'=>array(
            array('label'=>'Today', 'url'=>array('/session/index?sort=t')),
            array('label'=>'Yesterday', 'url'=>array('/session/index?sort=y')),
            array('label'=>'Current week', 'url'=>array('/session/index?sort=cw')),
            array('label'=>'Current month', 'url'=>array('/session/index?sort=cm')),
            array('label'=>'Last week', 'url'=>array('/session/index?sort=w')),
            array('label'=>'Last month', 'url'=>array('/session/index?sort=m')),
            array('label'=>'All time', 'url'=>array('/session/index?sort=e')),
            )),
       // array('label'=>'QC', 'url'=>array('/qc/list')),
        array('label'=>'QC', 'url'=>'#', 'items'=>array(
            array('label'=>'Today', 'url'=>array('/qc/list?sort=t')),
            array('label'=>'Yesterday', 'url'=>array('/qc/list?sort=y')),
            array('label'=>'Current week', 'url'=>array('/qc/list?sort=cw')),
            array('label'=>'Current month', 'url'=>array('/qc/list?sort=cm')),
            array('label'=>'Last week', 'url'=>array('/qc/list?sort=w')),
            array('label'=>'Last month', 'url'=>array('/qc/list?sort=m')),
            array('label'=>'All time', 'url'=>array('/qc/list?sort=e')),
            )), 
               
    array('label'=>'Schedule', 'url'=>'#',
    'items'=>array(
            array('label'=>$Calendar, 'url'=>array($linkCalendar)),
            array('label'=>$Scheduling, 'url'=>array('/schedule/schedule/list')),
            array('label'=>$swapshifts, 'url'=>array('/schedule/swap/index')),
            array('label'=>'Time off', 'url'=>array('/schedule/dayoff/index'))
            )),
                    
),
),
array(
'class'=>'bootstrap.widgets.TbMenu',
'htmlOptions'=>array('class'=>'pull-right'),
'items'=>array(
array('label'=>'Settings','url'=>'#','visible'=>Yii::app()->user->getName()==='admin',
'items'=>array(
        array('label'=>'Email','url'=> array('/setting/emails')),
        array('label'=>'Email Templates','url'=> array('/emailtemplate/admin'))
        )),
array('label'=>'Users','url'=>array('/user/admin'),'visible'=>Yii::app()->user->getName()==='admin'),
        array('label'=>'('.Yii::app()->user->name.')', 'url'=>'#', 'items'=>array(
                array('label'=>'Profile', 'url'=>array('/user/profile') ),
				array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
)),
),
),
);

 $this->widget('bootstrap.widgets.TbNavbar', array(
            'fixed'=>false,
            'brandUrl'=>'#',
            'fluid' => false,
            'type'=>'inverse',
            'fixed'=>'top',
            'collapse'=>true, // requires bootstrap-responsive.css
            'items'=>$this->menuMain,
            )); 
            
  ?>
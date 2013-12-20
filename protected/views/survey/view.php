<?php
$this->breadcrumbs=array(
	'Survey'=>array('admin'),
	""
);
?>

<? 
 function Viewdata($data){
 preg_match_all('/(\d+:\d+)\s*(AM|PM)/', $data, $match, PREG_PATTERN_ORDER);
 $t='';
 foreach($match[0] as $item ){
    if($t!==$item){
     $data = str_replace($item,'<br>'.$item,$data);
     $t=$item;
    }
 }
 return $data;
}
  
 ?> 




<div class="row">
<div class="span8">
<div class="widget-table">
<div class="widget-header"><h3><i class="icon-view"></i> View survey</h3></div>
<div class="widget-content">
<?php

foreach( $models as $model){
 $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
			'SessionID',
			'TechID',
			'TechSSOID',
			'TechName',
			'TechEmail',
			'TechDescr',
            // array('name'=>'ChatLog','type'=>'html','value'=>nl2br(str_replace("?","\r\n",str_replace(".", "\r\n",$model->ChatLog)))),
            array('name'=>'ChatLog','type'=>'html',
            'value'=>Viewdata($model->ChatLog)),
			'Note',
			'WaitingTime',
			'PickupTime',
			'ClosingTime',
			'WorkTime',
			'LastActionTime',
			'Transmitted',
			'Platform',
			'CField0',
			'CField1',
			'CField2',
			'CField3',
			'CField4',
			'CField5',
			'Tracking0',
	),
));

echo "<br/><hr/> ";

} ?>
</div>
</div>
</div>
</div>







<a href="#" class=" pull-right" onclick=" $.fn.yiiGridView.update('as-grid')"><i class="icon-refresh"></i> Refresh</a>
<?php

if(isset($data->rawData))
{ 
    $columns=array(
                    array(
                        'name'=>'sCustomField0',
                        'header'=>'Custumer'
                    ),
                    array(
                        'name'=>'sStatus',
                        'header'=>'Status'
                    ),                    
                    array(
                        'name'=>'sTechnician',
                        'header'=>'Technician'
                    ),                    
                   /*  array(
                        'name'=>'sStartTime',
                        'header'=>'Started'
                    ), */ 
                  );  
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'as-grid',
   // 'redirectRoute' => CHtml::normalizeUrl(''),
	'dataProvider'=>$data,
    'type'=>' striped bordered condensed ',
    'template'=>"{items}{pager}",
	'columns'=>$columns
)); } ?>

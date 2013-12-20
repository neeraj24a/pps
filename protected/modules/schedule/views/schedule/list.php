<?php
$this->breadcrumbs=array(
	'QC',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('schedule-grid', {
        data: $(this).serialize()
    });
    return false;
});
");


Yii::app()->clientScript->registerScript('create', "
$('#scheduleDg form').submit(function(){
      var url=$(this).attr('action');  
     $.post(url, $(this).serialize(),function(data){
       // console.log(data);
    $.fn.yiiGridView.update('schedule-grid', {
    });
        
     } );   
    return false;
});
");

?>

<?php

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$dialog = $this->widget('ext.ecolumns.EColumnsDialog', array(
       'options'=>array(
            'title' => 'Layout settings',
            'autoOpen' => false,
            'show' =>  'fade',
            'hide' =>  'fade',
        ),
     'htmlOptions' => array('style' => 'display: none'), //disable flush of dialog content
     'ecolumns' =>array(
            'gridId' => 'schedule-grid', //id of related grid
            'storage' => 'db',  //where to store settings: 'db', 'session', 'cookie'
            'fixedLeft' => array('CCheckBoxColumn'), //fix checkbox to the left side 
            'model' => $model->search()->model, //model is used to get attribute labels
            'columns' =>
            array(
                array(
                    'name'=>'username',
                ),
        		'date',
        		'starttime',
        		'endtime',
                'note',
                'dayoff:boolean'
                ))));
                     
$actions= array('class'=>'bootstrap.widgets.TbButtonColumn',
                			'template' => '{update} {delete}',
                            'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
                                array(
                                    'onchange'=>"$.fn.yiiGridView.update('schedule-grid',{data:{pageSize:$(this).val()}})",
                                    'style'=>'width:60px'
                                 )),

                			'buttons' => array(
                			      'view' => array(
                					'label'=> 'View',
                					'options'=>array(
                						'class'=>' view '
                					)
                				),
                                	
                				'update' => array(
                					'label'=> 'update',
                					'options'=>array(
                						'class'=>' update '
                					)
                				),
                                                                
                				'delete' => array(
                					'label'=> 'Delete',
                					'options'=>array(
                						'class'=>' delete '
                					)),
                                    
	                               'swap' => array(
                					'label'=> 'Swap',
                                    'url'=>'Yii::app()->createUrl("schedule/swap/create", array("id"=>$data->id))',
                					'options'=>array(
                					 'class'=>''  
                					),
                				)
                			),
                            //'htmlOptions'=>array('style'=>'width: 115px'),
                           );
                          
$columns=$dialog->columns();
if(!Helper::isAdmin())
$actions['template']="{swap}";

$columns[]=$actions;
                                               
?>


<div class="row">
<div class="span12">

<div class="widget widget-table ">
<div class="widget-header"><h3><i class="icon-list"></i> Manage Scheduling</h3></div>
<div class="widget-toolbar clearfix ">
<span class="search-form">
<?php
$this->renderPartial('_search',array('model'=>$model,));
?>
</span>
</div>


<div class="widget-content">
<?php 

$links=$dialog->link();
if(Helper::isAdmin())
$links.="<a  href='#scheduleDg' role='button' class='pull-left' data-toggle='modal'>&nbsp; <i class='icon-plus'></i> Create scheduling</a>";
$links.=CHtml::link('&nbsp; <i class="icon-calendar"></i> Calendar',Yii::app()->controller->createUrl('index'),array('class'=>' pull-left   '));


$this->widget('bootstrap.widgets.TbExtendedFilterGridView',array(
	'id'=>'schedule-grid',
    'redirectRoute' => CHtml::normalizeUrl(''),
	'dataProvider'=>$model->search(),
    'type'=>' striped bordered condensed ',
    'filter'=>$model,
    'template'=>"<span>".$links ."{summary}</span> {items}{pager}",
	'columns'=>$columns
)); ?>
</div>
</div>
</div>
</div>
<?php
	$model= new  Schedule();
 $repeat= new Repeat() ;
echo $this->renderPartial('_formModal', array('model'=>$model)); ?>

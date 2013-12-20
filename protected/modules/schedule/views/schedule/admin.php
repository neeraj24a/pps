<?php
$this->breadcrumbs=array(
	'Schedulings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Scheduling','url'=>array('index')),
	array('label'=>'Create Scheduling','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('scheduling-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

</div><!-- search-form -->
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
            'gridId' => 'scheduling-grid', //id of related grid
            'storage' => 'db',  //where to store settings: 'db', 'session', 'cookie'
            'fixedLeft' => array('CCheckBoxColumn'), //fix checkbox to the left side 
            'model' => $model->search()->model, //model is used to get attribute labels
            'columns' =>
            array(
                array(
                    'name'=>'user_id',
                    'type'=>'raw',
                    'value'=>array($this,'viewFullnameColum')
                ),
        		'date',
        		'starttime',
        		'endtime',       
            ))));
    $actions= array('class'=>'bootstrap.widgets.TbButtonColumn',
                			'template' => '{update}{delete}',
                            'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
                                array(
                                    'onchange'=>"$.fn.yiiGridView.update('scheduling-grid',{data:{pageSize:$(this).val()}})",
                                    'style'=>'width:60px'
                                 )),
                			'buttons' => array(
                			      'view' => array(
                					'label'=> 'View',
                					'options'=>array(
                					'class'=>' view  '
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
                					)
                				)
                			),
                           // 'htmlOptions'=>array('style'=>'width: 80px'),
                           );
    $columns=$dialog->columns();
    $columns[]=$actions;
    $links=$dialog->link();
    $links.=CHtml::link('&nbsp; <i class="icon-download"></i> Export to Excel',Yii::app()->controller->createUrl('GenerateExcel'),array('target'=>'_blank','class'=>' pull-left   '));
   // $links.='<a id="createSchudulingLink" href="#createSchuduling" role="button" class="pull-left" data-toggle="modal">&nbsp; <i class="icon-plus"></i> Create scheduling</span> </a>';
  ?>
<div class="row">
<div class="span12">
<div class="widget widget-table ">
<div class="widget-header"><h3><i class="icon-list"></i>Manage Schedulings</h3></div>
<div class="row-fluid">
    <div>
    <i class="icon-plus"></i>
    <?php echo CHtml::link('Create scheduling',array('schedule/create')); ?>
    </div>
</div>
<div>
    &nbsp;
</div>
<div class="widget-toolbar clearfix ">
<span class="search-form">
<?php $this->renderPartial('_search',array('model'=>$model,)); ?>
</span>
</div>
<div class="widget-content">
    <?php 
        $this->widget('bootstrap.widgets.TbExtendedFilterGridView',array(
    	'id'=>'scheduling-grid',
    	'dataProvider'=>$model->search(),
    	'type'=>' striped bordered condensed ',
        'filter'=>$model,
        'template'=>"<span>".$links ."{summary}</span> {items}{pager}",
    	'columns'=>$columns
    	
    ));
    ?>
</div>
</div>
</div>
</div>
<?php
//$model = new Scheduling;
//$this->renderPartial('create',array('model'=>$model));


?>

<?php
$this->breadcrumbs=array(
	'Simple Mailer Settings'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'Setting Mailer Settings', 'url'=>array('index')),
	array('label'=>'Create Mailer Setting', 'url'=>array('create')),
);
/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('simple-mailer-setting-grid', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h3>Manage Mailer Settings</h3>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'simple-mailer-setting-grid',
	'dataProvider'=>$model->search(),
    'type'=>' striped bordered condensed ',
	'filter'=>$model,
	'columns'=>array(
		array(
           'name'=>'rate',
           'value'=>'$data->rate!=null?$data->getRateSurvey($data->rate):""'
        ),
		array(
           'name'=>'template_id',
           'value'=>'$data->template!=null?$data->template->name:""'
        ),
		'autosend:boolean',
	
		array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
        'template' => '{update} {delete}',
		),
	),
)); ?>

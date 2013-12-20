<?php
$this->breadcrumbs=array(
	'Simple Mailer Lists'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Mailer Lists', 'url'=>array('index')),
	array('label'=>'Create Mailer List', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('simple-mailer-list-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Manage Simple Mailer Lists</h3>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'simple-mailer-list-grid',
	'dataProvider'=>$model->search(),
    'type'=>' striped bordered condensed ',
	'filter'=>$model,
	'columns'=>array(
		'name',
		'description',
		'query',
		'email_field',
		array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

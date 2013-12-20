<?php
$this->breadcrumbs=array(
	'Simple Mailer Templates'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Templates', 'url'=>array('index')),
	array('label'=>'Create Template', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('simple-mailer-template-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Manage Mailer Templates</h3>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'simple-mailer-template-grid',
    'type'=>' striped bordered condensed ',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'description',
		'from',
		'subject',
		//'body:html',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

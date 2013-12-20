<?php
$this->breadcrumbs = array(
	'Simple Mailer Queues' => array('index'),
	'Manage',
);

$this->menu = array(
	array('label' => 'List Queue', 'url' => array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('simple-mailer-queue-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Manage Mailer Queues</h3>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'simple-mailer-queue-grid',
	'dataProvider' => $model->search(),
    'type'=>' striped bordered condensed ',
	'filter' => $model,
	'columns' => array(
		'to',
		'subject',
		'status',
        'create_time',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{delete}',
		),
	),
)); ?>

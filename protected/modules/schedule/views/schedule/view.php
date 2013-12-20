<?php
$this->breadcrumbs=array(
	'Schedulings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Scheduling','url'=>array('index')),
	array('label'=>'Create Scheduling','url'=>array('create')),
	array('label'=>'Update Scheduling','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Scheduling','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Scheduling','url'=>array('admin')),
);
?>

<h1>View Scheduling #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'date',
		'starttime',
		'endtime',
		'repeat',
	),
)); ?>

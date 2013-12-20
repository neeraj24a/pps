<?php
$this->breadcrumbs=array(
	'Swaps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Swap','url'=>array('index')),
	array('label'=>'Create Swap','url'=>array('create')),
	array('label'=>'Update Swap','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Swap','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Swap','url'=>array('admin')),
);
?>

<h1>View Swap #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdate',
		'scheduling_from_id',
		'schedunling_to_id',
		'note',
		'acceptdate',
		'status',
	),
)); ?>

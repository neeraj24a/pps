<?php
$this->breadcrumbs=array(
	'Connect Forms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ConnectForm','url'=>array('index')),
	array('label'=>'Create ConnectForm','url'=>array('create')),
	array('label'=>'Update ConnectForm','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ConnectForm','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConnectForm','url'=>array('admin')),
);
?>

<h1>View ConnectForm #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'email',
		'fullname',
		'phone',
		'activation_code',
		'ip',
	),
)); ?>

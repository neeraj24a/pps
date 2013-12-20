<?php
$this->breadcrumbs=array(
	'Mailer Lists'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Mailer Lists', 'url'=>array('index')),
	array('label'=>'Create Mailer List', 'url'=>array('create')),
	array('label'=>'Update Mailer List', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mailer List', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mailer Lists', 'url'=>array('admin')),
);
?>

<h3>View Mailer List #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'description',
		'query',
		'email_field',
	),
)); ?>

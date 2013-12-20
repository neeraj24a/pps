<?php
$this->breadcrumbs=array(
	'Emailtemplates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Emailtemplate','url'=>array('index')),
	array('label'=>'Create Emailtemplate','url'=>array('create')),
	array('label'=>'Update Emailtemplate','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Emailtemplate','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Emailtemplate','url'=>array('admin')),
);
?>

<h3>View Emailtemplate #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'Subject',
		'Body:html',
		'Active:boolean',
	),
)); ?>

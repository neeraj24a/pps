<?php
$this->breadcrumbs=array(
	'Emailtemplates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Emailtemplate','url'=>array('index')),
	array('label'=>'Create Emailtemplate','url'=>array('create')),
	array('label'=>'View Emailtemplate','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Emailtemplate','url'=>array('admin')),
);
?>

<h3>Update Emailtemplate <?php echo $model->id; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
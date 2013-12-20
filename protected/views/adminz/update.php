<?php
$this->breadcrumbs=array(
	'Connect Forms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ConnectForm','url'=>array('index')),
	array('label'=>'Create ConnectForm','url'=>array('create')),
	array('label'=>'View ConnectForm','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ConnectForm','url'=>array('admin')),
);
?>

<h1>Update ConnectForm <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
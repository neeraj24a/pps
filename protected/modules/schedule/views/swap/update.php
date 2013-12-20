<?php
$this->breadcrumbs=array(
	'Swaps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Swap','url'=>array('index')),
	array('label'=>'Create Swap','url'=>array('create')),
	array('label'=>'View Swap','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Swap','url'=>array('admin')),
);
?>

<h1>Update Swap <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
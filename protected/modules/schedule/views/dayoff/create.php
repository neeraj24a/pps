<?php
$this->breadcrumbs=array(
	'Schedulings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Scheduling','url'=>array('index')),
	array('label'=>'Manage Scheduling','url'=>array('admin')),
);
?>

<div class="widget-header"><h3>Create Scheduling</h3></div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
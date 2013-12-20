<?php
$this->breadcrumbs=array(
	'Connect Forms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ConnectForm','url'=>array('index')),
	array('label'=>'Manage ConnectForm','url'=>array('admin')),
);
?>

<h1>Create ConnectForm</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
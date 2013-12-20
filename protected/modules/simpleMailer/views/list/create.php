<?php
$this->breadcrumbs=array(
	'Mailer Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mailer Lists', 'url'=>array('index')),
	array('label'=>'Manage Mailer Lists', 'url'=>array('admin')),
);
?>

<h3>Create Mailer List</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

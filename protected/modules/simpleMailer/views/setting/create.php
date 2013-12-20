<?php
$this->breadcrumbs=array(
	'Mailer Settings'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Mailer Settings', 'url'=>array('index')),
	array('label'=>'Manage Mailer Settings', 'url'=>array('admin')),
);
?>

<h3>Create Mailer Setting</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

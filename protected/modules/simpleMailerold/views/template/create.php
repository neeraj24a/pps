<?php
$this->breadcrumbs=array(
	'Mailer Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Templates', 'url'=>array('index')),
	array('label'=>'Manage Templates', 'url'=>array('admin')),
);
?>

<h3>CreateMailer Template</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

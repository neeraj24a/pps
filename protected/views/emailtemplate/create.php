<?php
$this->breadcrumbs=array(
	'Emailtemplates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Emailtemplate','url'=>array('index')),
	array('label'=>'Manage Emailtemplate','url'=>array('admin')),
);
?>

<h3>Create Emailtemplate</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Simple Mailer Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List Mailer Settings', 'url'=>array('index')),
	array('label'=>'Create Mailer Setting', 'url'=>array('create')),
	//array('label'=>'View Mailer Setting', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mailer Settings', 'url'=>array('admin')),
);
?>

<h3>Update Mailer List <?php echo $model->id; ?></h3>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

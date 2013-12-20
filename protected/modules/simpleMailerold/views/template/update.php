<?php
$this->breadcrumbs=array(
	'Simple Mailer Templates'=>array('index'),
	$model->name=>array('view','id'=>$model->name),
	'Update',
);

$this->menu=array(
	array('label'=>'List Templates', 'url'=>array('index')),
	array('label'=>'Create Template', 'url'=>array('create')),
	array('label'=>'View Template', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Templates', 'url'=>array('admin')),
);
?>

<h3>Update MailerTemplate <?php echo $model->name; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

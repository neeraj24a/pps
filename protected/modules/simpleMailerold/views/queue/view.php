<?php
$this->breadcrumbs = array(
	'Mailer Queues' => array('index'),
	$model->id,
);

$this->menu = array(
	array('label' => 'Delete Queued Element', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
	array('label' => 'Manage Queue', 'url' => array('admin')),
);
?>

<h3>View SimpleMailerQueue #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'to',
		'subject',
		'status',
	),
)); ?>

<?php
$this->breadcrumbs=array(
	'Mailer Templates',
);

$this->menu=array(
	array('label'=>'Create Template', 'url'=>array('create')),
	array('label'=>'Manage Templates', 'url'=>array('admin')),
);
?>

<h3>Mailer Templates</h3>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

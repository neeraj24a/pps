<?php
$this->breadcrumbs=array(
	'Mailer Lists',
);

$this->menu=array(
	array('label'=>'Create Mailer List', 'url'=>array('create')),
	array('label'=>'Manage Mailer Lists', 'url'=>array('admin')),
);
?>

<h3>Mailer Lists</h3>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Mailer Settings',
);

$this->menu=array(
	array('label'=>'Create Mailer Setting', 'url'=>array('create')),
	array('label'=>'Manage Mailer Settings', 'url'=>array('admin')),
);
?>

<h3>Mailer Lists</h3>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

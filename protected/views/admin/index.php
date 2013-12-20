<?php
$this->breadcrumbs=array(
	'Connect Forms',
);

$this->menu=array(
	array('label'=>'Create ConnectForm','url'=>array('create')),
	array('label'=>'Manage ConnectForm','url'=>array('admin')),
);
?>

<h1>Connect Forms</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Emailtemplates',
);

$this->menu=array(
	array('label'=>'Create Emailtemplate','url'=>array('create')),
	array('label'=>'Manage Emailtemplate','url'=>array('admin')),
);
?>

<h3>Emailtemplates</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

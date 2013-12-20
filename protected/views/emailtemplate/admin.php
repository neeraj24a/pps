<?php
$this->breadcrumbs=array(
	'Emailtemplates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Emailtemplate','url'=>array('index')),
	array('label'=>'Create Emailtemplate','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('emailtemplate-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Manage Emailtemplates</h3>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'emailtemplate-grid',
	'dataProvider'=>$model->search(),
    'type'=>' striped bordered condensed ',
	'filter'=>$model,
	'columns'=>array(
		'Subject',
		'Body:html',
		'Active:boolean',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

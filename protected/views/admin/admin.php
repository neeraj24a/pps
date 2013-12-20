<?php


$this->breadcrumbs=array(
	'Connect Forms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ConnectForm','url'=>array('index')),
	array('label'=>'Create ConnectForm','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('connect-form-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage The Connected Customer  </h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(	'model'=>$model,)); ?>
</div><!-- search-form -->


<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'connect-form-grid',
    'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'username',
		'password',
		'email',
		'fullname',
		'phone',
		'activation_code',
		'ip',
        'createdate',
		array(
		 'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>"10 items",20=>'20 items',50=>'50 items',100=>'100 items'),array(
              'onchange'=>"$.fn.yiiGridView.update('connect-form-grid',{ data:{pageSize: $(this).val() }})",'style'=>'width:65px'
          )),
          'template' => '{delete}',
           'buttons' => array(
            'delete' => array(
                'options'=>array(
            'class'=>' delete'
        )
    )
    ),
		),
	),
)); ?>

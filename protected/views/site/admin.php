<?php
$this->breadcrumbs=array(
	'Surveys',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('surveys-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<div class="row">
<div class="span12">

<div class="widget widget-table   ">
<div class="widget-header"><h3><i class="icon-list"></i> Manage Surveys</h3></div>
<div class="widget-toolbar clearfix ">
<?php echo CHtml::link('<i class="icon-search"></i> Search',Yii::app()->controller->createUrl('create'),array('accesskey'=>'t','class'=>'search-button btn btn-small btn-primary') );?>
</div>

<div class="search-form clearfix  " style="display:none">
<div class="widget widget-form">
<div class="widget-header"><h3><i class="icon-search"></i> Search</h3></div>
<div class="widget-content">
<?php
	$this->renderPartial('_search',array(
	'model'=>$model,
));
?>
</div>
</div>
</div><!-- search-form -->


<div class="widget-content">
<div class="dataTables_wrapper form-inline" role="grid" >
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'surveys-grid',
	'dataProvider'=>$model->search(),
    'type'=>' striped bordered  ',
//'filter'=>$model,
   // 'template'=>'{summary}{pager}{items}{pager}',
   'template'=>'{items} <div class="row"><div class="span6">{summary}</div> <div class="span6">{pager}</div></div>',
	'columns'=>array(
    'Name',
    'Email',
    'Phone',
    'CreateDate',
    array('name'=>'StatusSurvey','value'=>'$data->StatusSurvey!=null?$data->getStatusSurvey($data->StatusSurvey):""'),
    array('name'=>'RateSurvey','value'=>'$data->RateSurvey!=null?$data->getRateSurvey($data->RateSurvey):""'),
    'CommentSurvey',
    'SessionID',
    'TechID',
    'TechName',
       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{view}{delete}',
            'header'=>'Actions',
			'buttons' => array(
			      'view' => array(
					'label'=> 'View',
					'options'=>array(
						'class'=>' view btn btn-small '
					)
				),	
				'delete' => array(
					'label'=> 'Delete',
					'options'=>array(
						'class'=>' delete btn btn-small'
					)
				)
			),
            'htmlOptions'=>array('style'=>'width: 115px'),
           )
	),
)); ?>

</div>

</div>
</div>
</div>
</div>

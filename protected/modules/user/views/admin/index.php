<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t('Manage'),
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<div class="row">
<div class="span12">

<div class="widget widget-table ">
<div class="widget-header"><h3><i class="icon-list"></i> Manage Users</h3> </div>
<div class="widget-toolbar clearfix ">
<?php 
echo CHtml::link('<i class="icon-plus"></i> Add User',Yii::app()->controller->createUrl('create'),array('accesskey'=>'t','class'=>'btn btn-small btn-primary') );
echo " ";
echo CHtml::link('<i class="icon-search"></i> Search',Yii::app()->controller->createUrl('create'),array('accesskey'=>'t','class'=>'search-button btn btn-small btn-primary') );
?>
</div>


<div class="search-form clearfix  " style="display:none">
<div class="widget widget-form">
<div class="widget-header"><h3><i class="icon-search"></i> Search</h3></div>
<div class="widget-content">
<?php $this->renderPartial('_search',array('model'=>$model)); ?>
</div>
</div>
</div><!-- search-form -->


<div class="widget-content">
<div class="dataTables_wrapper " role="grid" >
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
    'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
    'template'=>'{items} <div class="row"><div class="span6">{summary}</div> <div class="span6">{pager}</div></div>',
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
        array(
			'header'=>'Full name',
			'type'=>'raw',
			'value'=>'$data->getFullname()',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		'create_at',
		'lastvisit_at',
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'header'=>'Actions',
			'template' => '{view} {update} {delete}',
			'buttons' => array(
		      'view' => array(
					'label'=> 'View',
					'options'=>array(
					'class'=>' view btn btn-small'
					)
				),	
                  'update' => array(
					'label'=> 'Update',
					'options'=>array(
					'class'=>' update btn btn-small'
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
</div></div>

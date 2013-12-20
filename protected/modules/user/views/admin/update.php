<?php
$this->breadcrumbs=array(
	(UserModule::t('Users'))=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	(UserModule::t('Update')),
);
$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('View User'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);
?>


<div class="row">
<div class="span8">
<div class="widget widget-form">
<div class="widget-header"><h3><i class="icon-edit"></i> Update User</h3></div>
<div class="widget-content">
<?php
$this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
</div>
</div>
</div>
<div class="span4">
<div class="widget widget-form ">
<div class="widget-header"><h3><i class="icon-tasks"></i> Actions </h3> </div>
<div class="widget-content">
<?php
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'list',
	'items'=>array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('View User'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    
	),
));
?>
</div>
</div>

</div>
</div>


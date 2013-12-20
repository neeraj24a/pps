<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('admin'),
	UserModule::t('Create'),
);

$this->menu=array(
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);
?>
<div class="row">
<div class="span8">
<?php
	$this->widget('bootstrap.widgets.TbBox', array(
    'title' => 'Add User',
    'headerIcon' => 'icon-plus',
    'htmlOptions'=>array('class'=>' widget-form '),
    'content' =>$this->renderPartial('_form', array('model'=>$model,'profile'=>$profile),true)
));
?>
</div>
</div>


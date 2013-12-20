<?php
$this->breadcrumbs=array(
	'Settings',
);
?>

<h3>
<i class="icon-cog"></i>
Settings </h3>

<div class="well">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'emailsetting-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="help-block">
    The system will send email when a disappointing review comes in
    </p>
	<?php echo $form->errorSummary($model); ?>
    <?php
//	var_dump($model);
?>
	<?php echo $form->textAreaRow($model,'emails',array('class'=>'span6')); ?>
    <p class="help-block"><b>Note:</b> Separate emails by comma</p>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
            'htmlOptions'=>array('name'=>'saveEmails')
		)); ?>
	</div>
<?php $this->endWidget(); ?>
</div>


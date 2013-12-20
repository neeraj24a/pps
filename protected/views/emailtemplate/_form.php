<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'emailtemplate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Subject',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->html5EditorRow($model,'Body',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->checkBoxRow($model,'Active',array('class'=>'span','template'=>'{input} {label}')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

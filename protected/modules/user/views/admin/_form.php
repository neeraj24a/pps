<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-form',
	//'enableAjaxValidation'=>true,
    'type'=>'horizontal',
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>
	<fieldset>
	<?php //echo $form->errorSummary(array($model,$profile)); ?>
	<?php echo $form->textFieldRow($model,'username',array('size'=>20,'maxlength'=>20)); ?>
    <?php echo $form->passwordFieldRow($model,'password',array('size'=>60,'maxlength'=>128)); ?>
	<?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>128)); ?>
	<?php echo $form->dropDownListRow($model,'superuser',User::itemAlias('AdminStatus')); ?>
    <?php echo $form->dropDownListRow($model,'status',User::itemAlias('UserStatus')); ?>
    <?php echo $form->dropDownListRow($model,'tech_id',CHtml::listData(Technician::model()->findAll(),"id","name"),array('prompt'=>'--Select one--')) ?>
    <?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	
		<?php
         //echo $form->labelEx($profile,$field->varname); 
         ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			//echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
            echo $form->dropDownListRow($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			//echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
            echo $form->textAreaRow($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			//echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
            echo $form->textFieldRow($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php //echo $form->error($profile,$field->varname); ?>
	
			<?php
			}
		}
?>
	<div class="form-actions">
		<?php 
                $this->widget('bootstrap.widgets.TbButton', array(
    			'buttonType'=>'submit',
    			'type'=>'primary',
                 'icon'=>'ok white',
                 'htmlOptions'=>array('id'=>'s','name'=>'s', 'class'=>' btn-large'),       
    			'label'=>$model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')));
         ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->
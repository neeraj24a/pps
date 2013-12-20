<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'swapwork-form',
	'enableAjaxValidation'=>false,
    'type'=>'inline',
    'htmlOptions'=>array('class'=>''),
)); ?>
<div class="row-fluid">
        <?php echo $form->label($model,'notecalloff',array());?>
        <textarea id="notecalloff" name="Schedule[notecalloff]" rows="10" class="span"></textarea>    
</div>
<?php echo $form->textField($model,'id',array('style'=>'visibility:hidden'));?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Apply',
            'htmlOptions'=>array('id'=>'apply')
		)); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Undo',
            'htmlOptions'=>array('id'=>'undo')
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'calloffad-form',
	'enableAjaxValidation'=>false,
    'type'=>'inline',
    'htmlOptions'=>array('class'=>''),
)); ?>
<div class="row-fluid">
    <div class="span6">
        <?php echo $form->label($model,'user_id',array());?>
        <?php echo $form->textField($model,'user_id',array('class'=>'span','readonly'=>'readonly'));?>
    </div>
    <div class="span6">
        <?php echo $form->label($model,'date',array());?>
        <?php echo $form->textField($model,'date',array('class'=>'span','readonly'=>'readonly'));?>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <?php echo $form->label($model,'starttime',array());?>
        <?php echo $form->textField($model,'starttime',array('class'=>'span','readonly'=>'readonly'));?>
    </div>
    <div class="span6">
        <?php echo $form->label($model,'endtime',array());?>
        <?php echo $form->textField($model,'endtime',array('class'=>'span ','readonly'=>'readonly'));?>
    </div>
</div>
<div class="row-fluid">
        <?php echo $form->label($model,'notecalloff',array());?>
        <textarea id="notecalloff" name="Schedule[notecalloff]" rows="6" class="span" readonly="readonly"></textarea>    
</div>
<?php echo $form->textField($model,'id',array('style'=>'visibility:hidden'));?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Accept',
            'htmlOptions'=>array('id'=>'Accept')
		)); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Un Accept',
            'htmlOptions'=>array('id'=>'Unaccept')
		)); ?>
	</div>

<?php $this->endWidget(); ?>
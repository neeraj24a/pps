<div id="sendEmailModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 380px;">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Send email to customers</h3>
</div>
<div class="modal-body">

<?php 

$model= new  SendEmailForm();
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'emailsetting-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>''),
)); ?>

   
   <?php
	echo $form->dropDownListRow($model,"template_name",CHtml::listData(SimpleMailerTemplate::model()->findAll(),"name","description"),
    array()
    );
?>
<label>Send to <span class="totalSend">0</span> customers selected</label>
<!--
<label>And </label>

-->
<?php
/*
	echo $form->dropDownListRow($model,"list_name",CHtml::listData(SimpleMailerList::model()->findAll(),"name","description"),
    array('prompt'=>'None')
    );
    */
   echo "<br>";
   $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Send',
            )); 

   
   echo $form->hiddenField($model,'ids');            
 $this->endWidget(); ?>
</div>
</div>

<div id="frmTimeOff" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Create time off for <?php echo Helper::getCurrUser()->username ?> </h3>
</div>
<div class="modal-body">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'dayoff-form',
	'enableClientValidation' => true,
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                ),
    'type'=>'vertical',
    'action'=>$this->createUrl('create') 
)); ?>
<?php echo $form->errorSummary($model); ?>

<div class="row-fluid ">
<div class="span5">
<?php  echo $form->datepickerRow($model,'fromdate',array('size'=>60,'maxlength'=>95, 'class'=>'span8', 'id'=>'datepicker', 'prepend'=>'<i class="icon-calendar"></i>', 'options'=>array('format' => 'yyyy/mm/dd', 'weekStart' => 5, 'viewMode' => 2, 'minViewMode' => 2))); ?>
 </div>
  <div class="span5">
 <?php 
 echo $form->datepickerRow($model,'todate',array('size'=>60,'maxlength'=>95, 'class'=>'span8', 'id'=>'datepickertodate', 'prepend'=>'<i class="icon-calendar"></i>', 'options'=>array('format' => 'yyyy/mm/dd', 'weekStart' => 5, 'viewMode' => 2, 'minViewMode' => 2)));
 ?>
 </div>

 </div>
 <div class="row-fluid ">
<div class="span5">
 <?php
 echo $form->dropDownListRow($model, 'starttime',$model->getListTime(),array( 'class'=>'span')) ;
 ?>
 </div>
 <div class="span5">
 <?php
 echo $form->dropDownListRow($model, 'endtime',$model->getListTime(),array( 'class'=>'span')) ;
 ?>
 </div>
  <div class="span2">
  <?php
 echo $form->checkBoxRow($model,"allday");
 ?>
 </div>
  </div>
<div class="row-fluid">
 <?php
 echo $form->textAreaRow($model,"note",array( 'class'=>'span')) ;
?>
</div>

<div class="form-actions" style="padding: 10px; 0px ">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Create time off',
		)); ?>
 
</div>

<?php $this->endWidget(); ?>
</div>
</div>
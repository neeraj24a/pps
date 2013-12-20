
<?php
	$model= new Schedule();
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'calloff-form',
	'enableClientValidation' => true,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                 'validateOnSubmit' => false,
                ),
    'type'=>'vertical',
)); ?>
<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
<?php
     if(isset($_GET['id']))
     $id=$_GET['id'];
     else $id=-1;
     $s= Schedule::model()->findByPk($id);
     if(isset($s)){
     $id=$s->id;
     $date=$s->date;
     $userid=$s->user_id;
     $lst= Schedule::model()->findAll("id=$id and date>=$date and user_id=$userid");
     } else 
     $lst= array(); 
     
	 $form->dropDownListRow($model,'id',CHtml::listData($lst,"id","date"));
     $form->textAreaRow($model,"notecalloff")
?>
</div>

<div class="form-actions" style="padding: 10px; 0px ">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
 
</div>

<?php $this->endWidget(); ?>

<script>
$(document).ready(function(){
 
});
</script>
<div class="well">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'swap-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    
    <?php
	   $m= Schedule::model()->findByPk($_GET['id']);
	 if(isset($_GET['id'])){
      if(isset($m)){
         echo " <h4> You want to swap  $m->date  $m->starttime -> $m->endtime </h4>";
      }
	 } 
     
    //$form->textFieldRow($model,'scheduling_from_id',array('class'=>'span5'));
    
    $s= Schedule::model()->findByPk($model->scheduling_to_id);
    if(isset($s))
    $v="$s->username $s->date";
    else $v=""; 
    
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'name'=>'Swap[scheduling_to_id_name]',
    'value'=>$v,
    'source'=>$this->createUrl('/schedule/schedule/GetListScheduling?id='.$_GET['id']),
    'options'=>array(
            'showAnim'=>'fold',
            'autoFill'=>'true',
            'select' => 'js:function(event, ui){jQuery("#Swap_scheduling_to_id").val(ui.item["id"]); }'
    ),
    ));
 
?>
	

	<?php echo $form->hiddenField($model,'scheduling_to_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'note',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

<script>
var url='<?php echo Yii::app()->createUrl('/schedule/schedule/GetListSheduling?id=').$_GET['id'] ?>';
var op=[]; 
 //$('#Swap_scheduling_to_idx').autocomplete(url,op);
</script>
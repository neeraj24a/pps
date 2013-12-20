<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'scheduling-form',
	'enableClientValidation' => true,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                ),
    'type'=>'vertical',
)); ?>
<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
    <div class="span6">
        <?php echo $form->dropDownListRow($model,"user_id",CHtml::listData(Profile::model()->findAll(),'user_id','lastname'),array('prompt'=>'select...','class'=>'span')); ?>
    </div>
    <div class="span6">
        <?php echo $form->labelEx($model,'date',array('class'=>' ')); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
              array(
                    'attribute'=>'date',
                    'model'=>$model,
                    'options' => array(
                                      'mode'=>'focus',
                                      'dateFormat'=>'yy/mm/dd',
                                      'showAnim' => 'slideDown',
                                      ),
            'htmlOptions'=>array('class'=>'span'),
                  )
            );?>  
    </div>
</div>

<div class="row-fluid">
    <div class="span6">
         <?php echo $form->dropDownListRow($model, 'starttime',$model->getListTime(),array( 'class'=>'span')) ;?>
    </div>
    <div class="span6">
    <?php echo $form->dropDownListRow($model, 'endtime',$model->getListTime(),array( 'class'=>'span')) ;?>
    </div>
</div>
<div class="row-fluid">
    <div class="span">
        <?php echo $form->textAreaRow($model,"note",array( 'class'=>'span','rows'=>'1')); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span2">
        <?php echo $form->checkBoxRow($model,"repeat",array('class'=>'repeat')); ?>
    </div>
</div>
<div>
<div class="form-repeat">
<div class="row-fluid ">
        <span class="pull-left" style="margin-right: 4px; ">
        <?php echo $form->checkBoxRow($model,"mon",array('class'=>'')); ?>
        </span>
        
        <span class="pull-left" style="margin-right: 4px; ">
        <?php echo $form->checkBoxRow($model,"tue",array('class'=>'')); ?>
        </span>
        <span class="pull-left" style="margin-right: 4px; ">
        <?php echo $form->checkBoxRow($model,"wed",array('class'=>'')); ?>
        </span>
        <span class="pull-left" style="margin-right: 4px; ">        
        <?php echo $form->checkBoxRow($model,"thu",array('class'=>'')); ?>
        </span>
        <span class="pull-left" style="margin-right: 4px; ">        
        <?php echo $form->checkBoxRow($model,"fri",array('class'=>'')); ?>
        </span>
        <span class="pull-left" style="margin-right: 4px; ">        
        <?php echo $form->checkBoxRow($model,"sat",array('class'=>'')); ?>
        </span>
        <span class="pull-left" style="margin-right: 4px; ">        
        <?php echo $form->checkBoxRow($model,"sun",array('class'=>'')); ?>
         </span>
 </div>

<div class="row-fluid ">
    <div class="span6">
        <?php echo $form->labelEx($model,'applydate',array('class'=>' ')); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
              array(
                    'attribute'=>'applydate',
                    'model'=>$model,
                    'options' => array(
                                      'mode'=>'focus',
                                      'dateFormat'=>'yy/mm/dd',
                                      'showAnim' => 'slideDown',
                                      ),
                'htmlOptions'=>array('class'=>'span'),
            ));?>
    </div>
    <div class="span6">
<?php echo $form->dropDownListRow($model,"totalweeks",array('1'=>'1 week','2'=>'2 week','3'=>'3 week','4'=>'4 week'),array('class'=>'span')); ?>        
    </div>
</div>
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
var fr= function(){
    if ($("input.repeat").is(':checked')) 
    $(".form-repeat").show(); else $(".form-repeat").hide();    
 }
fr(); 
 $("input.repeat").change(function(){ fr()}); 
});
</script>
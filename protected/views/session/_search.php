<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'search-session-form',
        'type'=>'search',
        'htmlOptions'=>array('class'=>'well'),
	   'action'=>Yii::app()->createUrl($this->route),
	   'method'=>'get',
));  ?>
<div class="input-prepend">
<span class="add-on"><i class="icon-calendar"></i></span>

 <?php 
         $this->widget('bootstrap.widgets.TbDateRangePicker', array(
                      'model'=>$model,
                      'attribute'=>'PickupTime',
                      'options'=>array('format'=>'yyyy/MM/dd'),
                      'htmlOptions'=>array('class'=>'input-medium','placeholder'=>'Date range PickupTime...') 
                        ));?>
     
    
</div>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go'));?>
<?php $this->endWidget(); ?>


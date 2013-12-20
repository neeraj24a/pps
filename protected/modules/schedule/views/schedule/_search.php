<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="input-prepend">
<div class="row-fluid">
    <div class="span3">
        <span class="add-on"><i class="icon-calendar"></i></span>
         <?php 
         $this->widget('bootstrap.widgets.TbDateRangePicker', array(
                      'model'=>$model,
                      'attribute'=>'date',
                      'options'=>array('format'=>'yyyy/MM/dd'),
                     // 'prepend'=>'<i class="icon-search"></i>',
                      'htmlOptions'=>array('class'=>'input-medium span','placeholder'=>'Date range input...') 
                        ));?>
    </div>
    <div class="span2">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go'));?>
    </div>
</div>
</div>
<?php $this->endWidget(); ?>

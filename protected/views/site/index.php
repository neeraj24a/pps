
<h3><i class=""></i> Overview</h3>




<?php  
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'search-session-form',
        'type'=>'search',
        'htmlOptions'=>array('class'=>' well modal hide fade '),
	   'action'=>Yii::app()->createUrl($this->route),
	   
));  ?>

<div class="input-prepend">
<span class="add-on"><i class="icon-calendar"></i></span>


 <?php 
      $this->widget('bootstrap.widgets.TbDateRangePicker', array(
                      'model'=>$dr,
                      'attribute'=>'DataR',
                      'options'=>array('format'=>'yyyy/MM/dd'),
                      'htmlOptions'=>array('class'=>'input-medium','placeholder'=>'Date range...') 
                        ));?>
     
    
</div>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'View'));?>
<?php $this->endWidget(); ?>


<?php
//$this->renderPartial('_chart',array('chartdata'=>$chartdata,'dr'=>$dr));
?>




<?php
	$obj = $this->Widget('application.extensions.dashboard.dashboard', array(
    'divColumns' => array('column1', 'column2', 'column3'),
    'dashHeader' => array('show'=>true, 'title'=>'Dashboard')
));
?>

<div class="column1">      
    <?php $obj->addPortlet('feeds', 'Feeds', 'Feeds Data');?>
    <?php $obj->addPortlet('news', 'News', 'News Data');?>
</div>
<div class="column2">
    <?php $obj->addPortlet('shopping', 'Shopping','Shopping Data');?> 
    <?php $obj->addPortlet('hits', 'Hits','Hits Data');?> 
</div>
<div class="column3">
    <?php $obj->addPortlet('weather', 'Weather', 'Whether Data');?>
    
</div>

<?php $obj->end()?>
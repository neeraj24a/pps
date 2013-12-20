<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'daterange',
        'type'=>'search',
        'htmlOptions'=>array('class'=>'well'),
	   'action'=>Yii::app()->createUrl($this->route),
	   'method'=>'post',
));  ?>
<div class="input-prepend">
<span class="add-on"><i class="icon-calendar"></i></span>

 <?php 
         $this->widget('bootstrap.widgets.TbDateRangePicker', array(
                      'model'=>$model,
                      'attribute'=>'DataR',
                      'options'=>array('format'=>'yyyy/MM/dd'),
                      'htmlOptions'=>array('class'=>'input-medium','placeholder'=>'Date range PickupTime...') 
                        ));?>
     
    
</div>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go'));?>

<div class="btn-group">
                    <button class="btn  dropdown-toggle" data-toggle="dropdown">Filter <span class="caret"></span></button>
                    <ul class="dropdown-menu range-date" >
                        <li><a href="#" value='t'>Today</a> </li>
                        <li><a href="#" value='y'>Yesterday</a> </li>   
                        <li><a href="#" value='cw' >Current week</a> </li>                          
                        <li><a href="#" value='cm' >Current month</a> </li>
                        <li><a href="#" value='lw' >Last week</a> </li>
                        <li><a href="#" value='lm' >Last month</a> </li>
                    </ul>
     </div>
<script>

var rd=<?php echo json_encode(Helper::getRangeDate());?>;
var setRangeDate=function(t){
    $('#DateRange_DataR').val(rd[t].f+"-" + rd[t].t);
    $('#daterange').submit();
}
$(document).ready(function(){
    $("ul.range-date li a").each( 
    function(){
    $(this).click(function(e){
     setRangeDate($(this).attr('value'));   
    })});
});

</script>
<?php $this->endWidget(); ?>


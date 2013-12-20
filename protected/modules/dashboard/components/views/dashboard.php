<div>
<a id="portlets-toggler" class="pull-right " href="#"><i class="icon-wrench"> </i> Settings</a>
<?php  
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'daterange',
        'type'=>'search',
        'htmlOptions'=>array('class'=>' '),
	   
));  ?>

<div class="input-prepend">
<span class="add-on"><i class="icon-calendar"></i></span>
 <?php 
 $dr= new  DateRange();
 if(isset($_POST['DateRange']['DataR']))
$dr->DataR=$_POST['DateRange']['DataR'];
 $this->widget('bootstrap.widgets.TbDateRangePicker', array(
                      'model'=>$dr,
                      'attribute'=>'DataR',
                      'options'=>array('format'=>'yyyy/MM/dd'),
                      'htmlOptions'=>array('class'=>'input-medium','placeholder'=>'Date range...') 
                        ));?>
     
    
</div>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'View'));?>


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

<?php $this->endWidget(); ?>

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

<?php
$param = CJavaScript::encode(array('baseUrl' => Yii::app()->createUrl('dashboard/default').'/'));
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'portlets-toggler-popup',
    'options' => array(
        'title' => 'Settings part',
        'modal' => true,
        'autoOpen' => false,
        'hide' => 'slide',
        'show' => 'slide',
        'buttons' => array(
          array(
            'text' => 'OK',
            'click' => "js:function() { Dashboard.fn.togglePortlets($param) }"
          ),
          array(
            'text' => 'Cancel',
            'click' => 'js:function() { $(this).dialog("close"); }',
          ),
        )
     )));
?>
    <ul>
    <?php foreach ($portlets as $column) : ?>
      <?php foreach ($column as $portlet) : ?>
      <li>
        <input class="portlets-toggle-item" type="checkbox" id="<?php print $portlet['class'] ?>-toggler" value="<?php print $portlet['class'] ?>"<?php print $portlet['visible'] ? ' checked="checked"' : '' ?> />
        <?php print $portlet['class'] ?>
      </li>
      <?php endforeach; ?>
    <?php endforeach; ?>
    </ul>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>

<div id="dashboard">

<div class="column" id="column-0">
<?php if (isset($portlets[0])) : ?>
  <?php foreach ($portlets[0] as $portlet) : ?>
  <?php $this->widget($portlet['class'], array('visible' => $portlet['visible'])) ?>
  <?php endforeach; ?>
<?php endif; ?>
</div>



<div class="column" id="column-1">
<?php if (isset($portlets[1])) : ?>
  <?php foreach ($portlets[1] as $portlet) : ?>
  <?php $this->widget($portlet['class'], array('visible' => $portlet['visible'])) ?>
  <?php endforeach; ?>
<?php endif; ?>
</div>



<div class="column" id="column-2">
<?php if (isset($portlets[2])) : ?>
  <?php foreach ($portlets[2] as $portlet) : ?>
  <?php $this->widget($portlet['class'], array('visible' => $portlet['visible'])) ?>
  <?php endforeach; ?>
<?php endif; ?>
</div>

</div>

<script>
function ajaxUpdatePart(e){
  var a=$('#'+e);  
  a.addClass('grid-view-loading');  
  $.get(location.href, function(data) {
    a.html($(data).find('#'+e).html());
    a.removeClass('grid-view-loading')
    });
return false;    
}
</script>

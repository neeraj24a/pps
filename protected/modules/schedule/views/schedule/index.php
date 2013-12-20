<?php
$this->breadcrumbs=array(
	'Schedulings',
);
?>

<h3>Calendar</h3>
<div class="row-fluid ">
    <div class="span2">
    
    <?php
	echo CHtml::link("List Scheduling",Yii::app()->controller->createUrl('list'));
    ?>
       
       <?php  $this->renderPartial('_listEmp'); 
            
       ?>
       
    </div>
    <div class="span10">
        <?php  $this->renderPartial('_calender', array('listeven'=>$listeven)); ?>
    </div>
</div>

<?php 
 //$model= new Schedule();
 //$this->renderPartial('_formModal', array('model'=>$model));
  ?>


<script>
    $(document).ready(function() {
        $('#list_emp input').attr('checked','checked'); 
        $('#list_emp input').click(function(){
            loadEvent(this);
        }); 
    });
    
    function addDescription(event, element){
        element.find('.fc-event-title').append("<br/>" + event.description);
    }
    var getEmpIds=function(){
    var re=[];
   $('#list_emp input:checked ').each( function(){
           re.push($(this).val()); 
       });
      return  re; 
    }
    
    var loadingEvent=false;
    function loadEvent(){
        if(loadingEvent) return; 
        loadingEvent=true;
        var url="<?php echo Yii::app()->controller->createUrl('LoadEvent') ;?>";
        var pData={ids:getEmpIds()};
        $.post(url,pData,function(data){
            var rel = eval("("+data+")");
            $('#calendar').fullCalendar('removeEvents').fullCalendar( 'addEventSource',rel.listEvent);
            loadingEvent=false;            
        });
     }

</script>


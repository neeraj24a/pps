<?php
$this->breadcrumbs=array(
	'Time off',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-formxx form').submit(function(){
    $.fn.yiiGridView.update('dayoff-grid', {
        data: $(this).serialize()
    });
    return false;
});
");


Yii::app()->clientScript->registerScript('create', "
$('#frmTimeOff form').submit(function(){
      var url=$(this).attr('action')+'?ajax=dayoff-form';  
     $.post(url, $(this).serialize(),function(data){
        var f=$(data).find('.alert-block');
        if(f.hasClass('alert-error')){
        $('#dayoff-form').html($(data).find('form').html());
        init_bdatepicker();
        }
        if(data=='ok') $('#frmTimeOff').modal('hide');
        $.fn.yiiGridView.update('dayoff-grid', { });
        
     } );   
    return false;
});
");

?>

<?php

$items=Dayoff::model()->getStatus();

$approved=array('name'=>'approved','type'=>'boolean');
if(Helper::isAdmin())
$approved= array(
                'name'=>'approved',
                'class'=>'bootstrap.widgets.TbEditableColumn',
                'filter'=>array('items'=>$items),
                'editable'=>array(
                'type'     => 'select',
                'source'   => $items,
                'url'       => $this->createUrl('dayoff/editable'),  //url for submit data
                'placement' => 'right',
               ));

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$dialog = $this->widget('ext.ecolumns.EColumnsDialog', array(
       'options'=>array(
            'title' => 'Layout settings',
            'autoOpen' => false,
            'show' =>  'fade',
            'hide' =>  'fade',
        ),
     'htmlOptions' => array('style' => 'display: none'), //disable flush of dialog content
     'ecolumns' =>array(
            'gridId' => 'dayoff-grid', //id of related grid
            'storage' => 'db',  //where to store settings: 'db', 'session', 'cookie'
            'fixedLeft' => array('CCheckBoxColumn'), //fix checkbox to the left side 
            'model' => $model->search()->model, //model is used to get attribute labels
            'columns' =>
            array(
                'username',
        		'fromdate',
                'todate',
        		'starttime',
        		'endtime',
                'note',
                $approved,
                ))));
                     
$actions= array('class'=>'bootstrap.widgets.TbButtonColumn',
                			'template' => '{delete}',
                            'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
                                array(
                                    'onchange'=>"$.fn.yiiGridView.update('schedule-grid',{data:{pageSize:$(this).val()}})",
                                    'style'=>'width:60px'
                                 )),

                			'buttons' => array(
                			      'view' => array(
                					'label'=> 'View',
                					'options'=>array(
                						'class'=>' view '
                					)
                				),
                                	
                				'update' => array(
                					'label'=> 'update',
                					'options'=>array(
                						'class'=>' update '
                					)
                				),
                                                                
                				'delete' => array(
                					'label'=> 'Delete',
                					'options'=>array(
                						'class'=>' delete '
                					)
                				)
                			),
                            //'htmlOptions'=>array('style'=>'width: 115px'),
                           );
                          
$columns=$dialog->columns();



if(Helper::isAdmin())
$actions['template']="";
$columns[]=$actions;
                                               
?>


<div class="row">
<div class="span12">

<div class="widget widget-table ">
<div class="widget-header"><h3><i class="icon-list"></i>Time Off</h3></div>
<div class="widget-toolbar clearfix ">
<span class="search-form">
<?php
//$this->renderPartial('_search',array('model'=>$model,));
$this->renderPartial('_form',array('model'=>$model,));
?>
</span>
</div>


<div class="widget-content">
<?php 

$links=$dialog->link();
if(!Helper::isAdmin())
$links.="<a  href='#frmTimeOff' role='button' class='pull-left' data-toggle='modal'>&nbsp; <i class='icon-plus'></i> Create time off</a>";
$links.=CHtml::link('&nbsp; <i class="icon-calendar"></i> Calendar',Yii::app()->createUrl('schedule/schedule/index'),array('class'=>' pull-left   '));


$this->widget('bootstrap.widgets.TbExtendedFilterGridView',array(
	'id'=>'dayoff-grid',
    'redirectRoute' => CHtml::normalizeUrl(''),
	'dataProvider'=>$model->search(),
    'type'=>' striped bordered condensed ',
    'filter'=>$model,
    'template'=>"<span>".$links ."{summary}</span> {items}{pager}",
	'columns'=>$columns
)); ?>
</div>
</div>
</div>
</div>
<script>
var init_bdatepicker=function(){
jQuery('#datepicker').bdatepicker({'format':'yyyy/mm/dd','weekStart':5,'viewMode':2,'minViewMode':2,'language':'en'});
jQuery('#datepickertodate').bdatepicker({'format':'yyyy/mm/dd','weekStart':5,'viewMode':2,'minViewMode':2,'language':'en'});    
}

</script>

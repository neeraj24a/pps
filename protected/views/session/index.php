<?php
$this->breadcrumbs=array(
	'Sessions',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('sessionlog-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>
<?php 
    if(isset($_GET['sort'])){
        if($_GET['sort']=='y'){
            $dateF = date("Y/m/d", time() - (60*60*24));
            $model->PickupTime = $dateF."-".$dateF;    
        }
        if($_GET['sort']=='t'){
            $dateF = date("Y/m/d", time());
            $model->PickupTime = $dateF."-".$dateF;    
        }
        if($_GET['sort']=='cw'){
            $end = date('Y/m/d',time());
            $start = date("Y/m/d",strtotime('last Monday'));
            $model->PickupTime = $start.'-'.$end;    
        }
        if($_GET['sort']=='cm'){
            $end = date('Y/m/d',time());
            $start = date("Y/m/1",time());
            $model->PickupTime = $start.'-'.$end;    
        }
        if($_GET['sort']=='w'){
            $end = date('Y/m/d',strtotime('last Sunday'));
            $start = date("Y/m/d",strtotime('last Sunday') - 6*24*3600);
            $model->PickupTime = $start.'-'.$end;
        }
        if($_GET['sort']=='m'){
            $end = date("Y/m/t",strtotime("-1 month"));
            $start = date("Y/m/1",strtotime("-1 month"));
            $model->PickupTime = $start.'-'.$end;
        }
    }
?>
<?php
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
            'gridId' => 'sessionlog-grid', //id of related grid
            'storage' => 'db',  //where to store settings: 'db', 'session', 'cookie'
            'fixedLeft' => array('CCheckBoxColumn'), //fix checkbox to the left side 
            'model' => $model->search()->model, //model is used to get attribute labels
            'columns' =>
            array(
                    'CField0',
                    'CField1',
                    'CField2',
                    'SessionID',
			        'TechID',
			        'TechSSOID',
			        'TechName',
			        'TechEmail',
			        'TechDescr',
                    array('name'=>'ChatLog',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>array($this,'viewChat'), 
                        ),
			        'Note',
			        'WaitingTime',
			        'PickupTime',
			        'ClosingTime',
			        'WorkTime',
			        'LastActionTime',
			        'Transmitted',
			        'Platform',
            ))));

$actions= array('class'=>'bootstrap.widgets.TbButtonColumn',
                			'template' => '{delete}',
                            'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
                                array(
                                    'onchange'=>"$.fn.yiiGridView.update('sessionlog-grid',{data:{pageSize:$(this).val()}})",
                                    'style'=>'width:60px'
                                 )),
                			'buttons' => array(
                			      'view' => array(
                					'label'=> 'View',
                					'options'=>array(
                					'class'=>' view  '
                					)
                				),	
                				'delete' => array(
                					'label'=> 'Delete',
                					'options'=>array(
                					'class'=>' delete '
                					)
                				)
                			),
                           // 'htmlOptions'=>array('style'=>'width: 80px'),
                           );
$columns=$dialog->columns();
$columns[]=$actions;
?>
<div class="row">
<div class="span12">
<div class="widget widget-table ">
<div class="widget-header"><h3><i class="icon-list"></i>Manage Sessions</h3></div>
<div class="widget-toolbar clearfix ">
<span class="search-form">
<?php $this->renderPartial('_search',array('model'=>$model,)); ?>
</span>
</div>
<div class="widget-content">
    <?php 
$links=$dialog->link();
$links.=CHtml::link('&nbsp; <i class="icon-download"></i> Export to Excel',Yii::app()->controller->createUrl('GenerateExcel'),array('target'=>'_blank','class'=>' pull-left   '));

$this->widget('bootstrap.widgets.TbExtendedFilterGridView',array(
    	'id'=>'sessionlog-grid',
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


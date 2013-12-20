<?php
$this->breadcrumbs=array(
	'Surveys',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('surveys-grid', {
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
            $model->CreateDate = $dateF."-".$dateF;    
        }
        if($_GET['sort']=='t'){
            $dateF = date("Y/m/d", time());
            $model->CreateDate = $dateF."-".$dateF;    
        }
        if($_GET['sort']=='cw'){
            $end = date('Y/m/d',time());
            $start = date("Y/m/d",strtotime('last Monday'));
            $model->CreateDate = $start.'-'.$end;    
        }
        if($_GET['sort']=='cm'){
            $end = date('Y/m/d',time());
            $start = date("Y/m/1",time());
            $model->CreateDate = $start.'-'.$end;    
        }
        if($_GET['sort']=='w'){
            $end = date('Y/m/d',strtotime('last Sunday'));
            $start = date("Y/m/d",strtotime('last Sunday') - 6*24*3600);
            $model->CreateDate = $start.'-'.$end;
        }
        if($_GET['sort']=='m'){
            $end = date("Y/m/t",strtotime("-1 month"));
            $start = date("Y/m/1",strtotime("-1 month"));
            $model->CreateDate = $start.'-'.$end;
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
            'gridId' => 'surveys-grid', //id of related grid
            'storage' => 'db',  //where to store settings: 'db', 'session', 'cookie'
            'fixedLeft' => array('CCheckBoxColumn'), //fix checkbox to the left side
            
            'model' => $model->search()->model, //model is used to get attribute labels
            'columns' =>
            array(
            
             array(
                'class' => 'CCheckBoxColumn',
                'id'=>'selectedItems',
                  ),
                    'Name',
                    array(
                    'name'=>'Email',
                    'type'=>'html',
                    'value'=>'$data->showEmail()'
                     ),
                    'Phone',
                    'CreateDate',
                    array('name'=>'Status',
                    'value'=>'$data->Status!=null?$data->getStatusSurvey($data->Status):""',
                    'filter'=>array('items'=>Survey::model()->getStatusSurvey())
                    ),
                    array('name'=>'Rate','value'=>'$data->Rate!=null?$data->getRateSurveyFull($data->Rate):""',
                    'filter'=>array('items'=>Survey::model()->getRateSurveyFull())
                    ),
                    array(
                        'name'=>'Comment',
                        'type'=>'raw',
                        'value'=>'$data->Comment',
                        'htmlOptions'=>array("style"=>"width:200px")
                        
                    ),
                     array('name'=>'SessionID','type'=>'html',
                       'value'=>'CHtml::link($data->SessionID, Yii::app()->createUrl("survey/$data->SessionID"))'
                      ),

                      'TechID',
                      'TechName',
                      'TechEmail',
                       array(
                       'name'=>'SentEmail',
                       'value'=>'$data->SentEmail',
                       'type'=>'boolean'
                       ) 

                     ))));
                     
$actions= array('class'=>'bootstrap.widgets.TbButtonColumn',
                			'template' => '{delete}',
                            'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
                                array(
                                    'onchange'=>"$.fn.yiiGridView.update('surveys-grid',{data:{pageSize:$(this).val()}})",
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
if(Yii::app()->user->username==='admin')
$columns[]=$actions;
                                               
?>


<div class="row">
<div class="span12">

<div class="widget widget-table    ">
<div class="widget-header"><h3><i class="icon-list"></i> Manage Surveys</h3></div>
<div class="widget-toolbar clearfix ">
<span class="search-form">
<?php
$this->renderPartial('_search',array('model'=>$model,));
?>
</span>
</div>

<div class="widget-content">
<?php 

$links=$dialog->link();
$links.=CHtml::link('&nbsp; <i class="icon-download"></i> Export to Excel',Yii::app()->controller->createUrl('GenerateExcel'),array('target'=>'_blank','class'=>' pull-left   '));
$links.='<a id="sendEmailLink" href="#sendEmailModal" role="button" class="pull-left" data-toggle="modal">&nbsp; <i class="icon-envelope"></i> Send Email <span class="totalSend"></span> </a>';

$this->widget('bootstrap.widgets.TbExtendedFilterGridView',array(
	'id'=>'surveys-grid',
    'redirectRoute' => CHtml::normalizeUrl(''),
	'dataProvider'=>$model->search(),
    'type'=>' striped bordered condensed ',
    'filter'=>$model,
    'afterAjaxUpdate'=>" function(id,data){
        sendMail.afterAjaxUpdate(id,data);
    } ",
    'selectionChanged'=>' function(id){sendMail.selectionChanged(id);}',
    'selectableRows' => 2,
    'template'=>"<span>".$links ."{summary}</span> {items}{pager}",
	'columns'=>$columns
)); ?>
</div>
</div>
</div>
</div>

<?php
$this->renderPartial('sendEmail');
?>
<script>

var sendMail={};
sendMail.currpage=1;
sendMail.lst=[];
sendMail.ftrig=false ;
sendMail.getCurrpage= function(){
  sendMail.currpage=$("ul.yiiPager li.active a").html();
  if(sendMail.currpage==null)
  sendMail.currpage=1;
}
sendMail.selectionChanged= function(gridId){
  if(!sendMail.ftrig)  
  sendMail.lst[sendMail.currpage]=$.fn.yiiGridView.getSelection("surveys-grid");
  sendMail.updateTotalSend();
}
sendMail.afterAjaxUpdate=function(id,data){
    sendMail.getCurrpage();
    sendMail.updateChk();
}

sendMail.Total=function(){
    var t=0;
    for( i in sendMail.lst){
     t +=sendMail.lst[i].length;      
    }
    return t;
}

sendMail.updateTotalSend=function(){
    $('.totalSend').html(sendMail.Total()).addClass(' badge badge-important ');
    $('#SendEmailForm_ids').val(sendMail.lst);
  
}
sendMail.updateChk=function(){
    sendMail.ftrig=true;
    for (i in sendMail.lst[sendMail.currpage]){
         var id=sendMail.lst[sendMail.currpage][i];
         var e=$("input[value='"+ id +"']");
            e.click();
            e.attr('checked', 'checked');
    }
    sendMail.ftrig=false;  
}
</script>

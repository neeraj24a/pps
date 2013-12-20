<?php
$this->breadcrumbs=array(
	'Swaps'=>array('index'),
	'Manage',
);
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
            'gridId' => 'swap-grid', //id of related grid
            'storage' => 'db',  //where to store settings: 'db', 'session', 'cookie'
            'fixedLeft' => array('CCheckBoxColumn'), //fix checkbox to the left side
            
            'model' => $model->search()->model, //model is used to get attribute labels
            'columns' =>
            array(
        		'createdate',
        		array(
                'name'=>'scheduling_from_id',
                'value'=>'$data->scheduling_from',
                ),
                array(
                'name'=>'scheduling_to_id',
                'value'=>'$data->scheduling_to',
                ),
        		'note',
        		//'acceptdate',
        		 array(
                                'name'=>'status',
                                'class'=>'bootstrap.widgets.TbEditableColumn',
                                'filter'=>array('items'=>Swap::model()->getStatus()),
                                'editable'=>array(
                                'type'     => 'select',
                               'source'   => Swap::model()->getStatus(),
                                'url'       => $this->createUrl('swap/editable'),  //url for submit data
                                'placement' => 'right',
                               )
                                ),

                     ))));
                     
$actions= array('class'=>'bootstrap.widgets.TbButtonColumn',
                			'template' => '{delete}',
                            'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
                                array(
                                    'onchange'=>"$.fn.yiiGridView.update('swap-grid',{data:{pageSize:$(this).val()}})",
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
//if(Helper::isAdmin())
$columns[]=$actions;
                                               
?>


<div class="row">
<div class="span12">

<div class="widget widget-table    ">
<div class="widget-header">
<a href="#"  id="example" class="pull-right " data-toggle="popover" data-placement="bottom" title="" data-content="You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt;
or =) at the beginning of each of your search values to specify how the comparison should be done. " data-original-title="Help">Help?</a>
<h3><i class="icon-list"></i> Manage Shift Swaps</h3>
</div>
<div class="widget-toolbar clearfix ">


</div>

<div class="widget-content">
<?php 

$links=$dialog->link();
//$links.=CHtml::link('&nbsp; <i class=" icon-plus"></i>Create shift swaps',Yii::app()->controller->createUrl('create'),array('class'=>' pull-left   '));
$links.=CHtml::link('&nbsp; <i class="icon-calendar"></i> Calendar',Yii::app()->createUrl('schedule/schedule/index'),array('class'=>' pull-left   '));

$this->widget('bootstrap.widgets.TbExtendedFilterGridView',array(
	'id'=>'swap-grid',
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
$('#example').popover()
</script>

<?php

$this->breadcrumbs=array(
	'Customers',
);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

    $('.search-form').slideToggle('fast');

    return false;

});

$('.search-form form').submit(function(){

    $.fn.yiiGridView.update('customerlog-grid', {

        data: $(this).serialize()

    });

    return false;

});

");



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

            'gridId' => 'customerlog-grid', //id of related grid

            'storage' => 'db',  //where to store settings: 'db', 'session', 'cookie'

            'fixedLeft' => array('CCheckBoxColumn'), //fix checkbox to the left side 

            'model' => $model->search()->model, //model is used to get attribute labels

            'columns' =>

            array(
                    'Name',
                    'Email',
                    'Phone',
                    'CreateDate',
                    
                     array(
                        'name'=>'Rate',
                        'type'=>'raw',
                        'value'=>'isset($data->Rate)?$data->rate_text:""',
                        'filter'=>array('items'=>Customerlog::model()->getRate()),
                        ),

                     array(
                        'name'=>'Status',
                        'class'=>'bootstrap.widgets.TbEditableColumn',
                        'filter'=>array('items'=>Customerlog::model()->getStatus()),
                        'editable'=>array(
                        'type'     => 'select',
                        'source'   => Customerlog::model()->getStatus(),
                        'url'       => $this->createUrl('survey/editable'),  //url for submit data
                        'placement' => 'left',
                       )
                        ),
                      
                       array(
                       'class'=>'bootstrap.widgets.TbEditableColumn',
                      'name' => 'Comment',
                       'editable'=>array(
                       'value'=>'$data->Comment',
                        'url'       => $this->createUrl('survey/editable'),  //url for submit data
                        'placement' => 'left',
                       )),  
                        
                     ))));

                     

$actions= array('class'=>'bootstrap.widgets.TbButtonColumn',
                			'template' => '{delete}',
                            'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
                                array(
                                    'onchange'=>"$.fn.yiiGridView.update('customerlog-grid',{data:{pageSize:$(this).val()}})",
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
<h1>
<a href="http://www.remoterestore.com/tech/">Coupon Code: save1 for $100 OFF</a>
</h1>

<div class="span12">

<div class="widget widget-table    ">
<div class="widget-header"><h3><i class="icon-list"></i>Manage Sales</h3></div>
<div class="widget-toolbar clearfix ">
<?php

 echo $dialog->link();

 echo "<span class=' pull-right '> ";

 echo CHtml::link('<i class="icon-download"></i> Export to Excel',Yii::app()->controller->createUrl('GenerateExcel'),array('target'=>'_blank','class'=>' btn btn-small btn-primary'));

 echo "</span> ";

?>

</div>

<div class="search-form clearfix  " style="display:none">

<div class="widget widget-form">

<div class="widget-header"><h3><i class="icon-search"></i> Search</h3></div>

<div class="widget-content">

<?php

	$this->renderPartial('_searchCus',array(

	'model'=>$model,

));

?>

</div>

</div>

</div><!-- search-form -->



<div class="widget-content">

<?php $this->widget('bootstrap.widgets.TbExtendedFilterGridView',array(

	'id'=>'customerlog-grid',

    'redirectRoute' => CHtml::normalizeUrl(''),

	'dataProvider'=>$model->search(),

    'type'=>' striped bordered condensed ',

    'filter'=>$model,

  // 'template'=>'{items}{pager}',

	'columns'=>$columns

)); ?>

</div>

</div>

</div>

</div>


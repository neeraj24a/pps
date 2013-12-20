
<style>
table th {text-align: center  !important ; }
table td {text-align: right !important ; }
table td.name {text-align: left !important ; }
</style>
<?php
/* @var $this TechController */

$this->breadcrumbs=array(
	'Tech',
);
?>

<?php
	
?>

<div class="row">
<div class="span12">
<div class="widget widget-table ">
<div class="widget-header"><h3><i class="icon-list"></i> The technician performance</h3></div>
<div class="widget-toolbar clearfix ">
<span class="search-form">
<?php $this->renderPartial('_search',array('model'=>$dr,)); ?>
</span>
</div>

<?php
    $listView= $this->renderPartial("_listView",array("model"=>$model),true);
    $stackedColumnChart=$this->renderPartial("_stackedColumnChart",array("model"=>$model),true);
    $StackedPercentageColumn=$this->renderPartial("_stackedPercentageColumn",array("model"=>$model),true);

	$this->widget('bootstrap.widgets.TbTabs', array(
	'type'=>'tabs', // 'tabs' or 'pills'
	'tabs'=>array(
		array('label'=>'List View', 'content'=>$listView, 'active'=>true),
		array('label'=>'Stacked Column Chart', 'content'=>$stackedColumnChart),
		array('label'=>'Stacked Percentage Column', 'content'=>$StackedPercentageColumn),
	),
));
?>

</div>
</div>
</div>



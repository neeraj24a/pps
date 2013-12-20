<?php
$this->breadcrumbs=array(
	$this->module->id,
);

?>

<style>
.dashboard-processed .column{ width: 33% !important;}
</style>
<h3><?php echo "Dashboard's ".Yii::app()->user->name ?></h3>

<?php $this->widget('DWidget', array('portlets' => $portlets)); ?>
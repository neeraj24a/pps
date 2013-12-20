<?php if(Helper::isAdmin()){ ?>
<?php
	$listUser = Profile::model()->findAll();
?>
<div class="well">
<h5>Filter technician</h5>

<?php echo CHtml::checkBoxList('list_emp',-1,
CHtml::listData($listUser,'user_id','lastname'),
    array(
    'labelOptions'=>array(
    'style'=>'display:inline'),
    'class'=>'row','checkAll' => 'Select all'
    ));?>
</div>
<?php } ?>
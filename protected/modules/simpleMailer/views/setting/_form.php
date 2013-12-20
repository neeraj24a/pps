<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'simple-mailer-setting-form',
	'enableAjaxValidation'=>false,
    
)); ?>

	<?php echo $form->errorSummary($model); ?>
    <div class="row">
<?php 	echo $form->dropDownListRow($model,"rate", $model->getRateSurvey()); ?> </div>

     <div class="row"> <?php  $data=SimpleMailerTemplate::model()->findAll(); ?></div>
     <div class="row"><?php   echo $form->dropDownListRow($model,"template_id",CHtml::listData($data,"id","name")); ?></div>
     <div class="row">  <?php echo $form->checkBoxRow($model,"autosend"); ?></div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
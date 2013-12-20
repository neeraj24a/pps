<?php
$this->layout='//layouts/simple';

?>

<?php
	if(isset($_GET['RescueSessionID'])){
?>

<div class="form surveyform span3 offset3 ">
<div class="well span5">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'survey-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<?php
	$model= new SurveyForm();
?>

<h1>Evaluate your session</h1>
<p>Please take a moment to tell us about the support session that just ended.</p>
<?php 

echo $form->dropDownListRow($model,'status',ConnectForm::model()->getStatusSurvey(),array('class'=>'span4','prompt'=>'select one...'));
echo $form->dropDownListRow($model,'rate', ConnectForm::model()->getRateSurvey(),array('class'=>'span4','prompt'=>'select one...'));
echo $form->textAreaRow($model,'comment',array('class'=>'span4'));

 ?>

<br />
	
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Submit',
		)); ?>
	

<?php $this->endWidget(); ?>

</div>
</div><!-- form -->
<?php } else { ?>

<div class="alert alert-block alert-success span4 offset3  ">
<strong>Thank you</strong>
<br />
Your session survey has been sent.
</div>


<?php } ?>

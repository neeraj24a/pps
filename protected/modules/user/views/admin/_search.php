
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'type'=>'horizontal' 
)); ?>

    <fieldset>
        <?php  echo $form->textFieldRow($model,'username',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->textFieldRow($model,'activkey',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->textFieldRow($model,'create_at'); ?>
        <?php echo $form->textFieldRow($model,'lastvisit_at'); ?>
        <?php echo $form->dropDownListRow($model,'superuser',$model->itemAlias('AdminStatus')); ?>
        <?php echo $form->dropDownListRow($model,'status',$model->itemAlias('UserStatus')); ?>
        <?php echo $form->hiddenField($model,'id'); ?>
        <div class="form-actions">
         <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Search')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
        </div>
    </fieldset>    
    

<?php $this->endWidget(); ?>


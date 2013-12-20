
<div class="form connectform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'connect-form',
    'action'=>'https://secure.logmeinrescue.com/Customer/Download.aspx',
    'method'=>'post',
    'htmlOptions'=>array('name'=>'channel862904309'),
    //'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>TRUE)

)); ?>
	<div class="sub2">
        <table>
        <tr>
        <td align="right"><?php echo $form->label($model,'Name'); ?>:</td>
        <td><?php echo $form->textField($model,'Name'); ?>
         <?php echo $form->error($model,'Name'); ?>
        </td>
        </tr>
        <tr>
        <td align="right"><?php echo $form->label($model,'Email'); ?>:</td>
        <td><?php echo $form->textField($model,'Email'); ?>
        <?php echo $form->error($model,'Email'); ?>
        </td>
        </tr>
        <tr>
        <td align="right"><?php echo $form->label($model,'Phone'); ?>:</td>
        <td><?php echo $form->textField($model,'Phone');?>
        <?php echo $form->error($model,'Phone'); ?>
        </td>
        </tr>
        </table>
       
	</div>

	<div class="sub">
    <img src="images/sub3.png" />
    </div>
    <div class="sub4">
        <table>
        <tr>
        <td>
        <div class="box">
            <span>If you have an <strong>Activation code,</strong><br />please enter here</span><br />
        	<?php echo $form->textField($model,'ActivationCode'); ?>
            <?php echo $form->error($model,'ActivationCode'); ?>
        </div>
        </td>
        <td>
        <label><strong>OR</strong></label>
        </td>
        <td>
        <div class="box">
        <span>If you have an <strong>User Name</strong> and <br /> <strong>Password,</strong> please enter them here</span><br />
        <table>
        <tr>
        <td> <?php echo $form->label($model,'UserName'); ?>:</td>
        <td> <?php echo $form->textField($model,'UserName'); ?></td>
        </tr>
        <tr>
         <td><?php echo $form->label($model,'Password'); ?>:</td>
        <td> <?php echo $form->passwordField($model,'Password'); ?></td>
        </tr>
        </table>
        </div>
        </td>
        </tr>
        </table>
    </div>

	<div class="sub5">
        <div class="connect">
		<?php echo CHtml::submitButton(''); ?>
        </div>        
       <!-- <h1 class="bs"><strong>When prompted, choose Run/Okay/Allow/Continue</strong></h1> -->
	</div>
    	<div class="sub">
         <img src="images/sub6.png" />
        </div>


    <input type="hidden" name="EntryID" value="862904309" />
    <input type="hidden" name="tracking0" maxlength="64" /> <!-- optional -->
    <input type="hidden" name="language" maxlength="5" /> <!-- optional -->
    

<?php $this->endWidget(); ?>
</div><!-- form -->


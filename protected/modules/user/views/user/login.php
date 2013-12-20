<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<div class="account-container login">
<div class="content clearfix">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
        'validateOnSubmit' => true,
        ),
          ));
    ?>
    	<h1>Sign In</h1>		
    	<div class="login-fields">
            <p>Sign in using your registered account:</p>    
            <div class="field">
                <?php echo $form->textFieldRow($model, 'username', array('class' => '  login username-field ','placeholder'=>'Username')) ?>
             </div>
               <div class="field">  
                <?php echo $form->passwordFieldRow($model, 'password', array('class' => ' login password-field ')) ?>
            </div>            
      </div>
     <div class="login-actions">
         <span class="login-checkbox">
                    <?php echo $form->checkBox($model, 'rememberMe',array('class'=>' field login-checkbox ')); ?>
                    <?php echo $form->labelEx($model, 'rememberMe',array('class'=>' choice ')); ?>
    	</span>
        <?php echo CHtml::htmlButton('Sign In', array('class' => 'button btn btn-secondary btn-large', 'type' => 'submit')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
</div>

<!-- Text Under Box -->
<div class="login-extra">
	Don't have an account? <?php echo CHtml::link(UserModule::t("Sign Up"),Yii::app()->getModule('user')->registrationUrl); ?><br/>
	Remind <?php echo CHtml::link(UserModule::t("Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
</div> <!-- /login-extra -->

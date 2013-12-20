<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div>
<!--
 	<div id="logo">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" />
	</div> logo -->
    
<?php
$menuMain=array();
?>
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
            'fixed'=>false,
            'brandUrl'=>'#',
            'fluid' => false,
            'type'=>'inverse',
            'fixed'=>'top',
            'collapse'=>true, // requires bootstrap-responsive.css
            'items'=>$menuMain,
            )); ?>
   
<div class="container" style="margin-top: 40px;">
        
	<?php echo $content; ?>
   
</div><!-- page -->
<div class="clear"></div>

</body>
</html>

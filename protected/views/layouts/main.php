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

<div class="container" id="page">

	<div id="header">
     <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/header.png" />
    </div><!-- header -->
 	<div id="logo">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" />
	</div><!-- logo -->
	<?php echo $content; ?>


	<div class="clear"></div>

</div><!-- page -->

</body>
</html>

<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/admin'); ?>
<div class="span8">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span3  ">
<div  class="content">
	<div id="sidebar">
	<?php
		$this->beginWidget('bootstrap.widgets.TbBox', array(
			'title'=>'Operations',
		));
		$this->widget('bootstrap.widgets.TbMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>
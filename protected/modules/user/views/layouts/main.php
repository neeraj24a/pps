
<?php $this->beginContent($this->module->appLayout); ?>
<div class="row-fluid">
  <div class="span2 " id="left-menu">
          <div class="well sidebar-nav sidebar-nav-fixed well-small">
    	<?php $this->renderPartial('/_leftmenu'); ?>
        </div>
    </div>
    <div class="span10" id="view-content">
      <!--Body content-->
      <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
      <div class="row-fluid ">
      <div class="span12">
        <?php echo $content; ?>
        </div>
     </div>
    </div>    
 </div>

<?php $this->endContent(); ?>
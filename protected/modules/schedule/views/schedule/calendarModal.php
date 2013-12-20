<div id="calendarModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Application for leave <span class="totalSend"></span></h3>

</div>
<div class="modal-body">
    <?php  $this->renderPartial('_form_call_off',array('model'=>$model,'swap'=>$swap));?>   
</div>
</div>
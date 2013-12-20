
<div id="frmShowCallOff" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Request a Day Off</h3>
</div>
<div class="modal-body">

    <div class="well">
    <span><label id="username">sdsadsadsa</label></span>
    </div>
    
    <div class="well">
    <label>Reason:</label>
    <span id="note">sdsadsa</span>
    </div>

<div>
<div class="span">
 <label for="noteaccept">Note</label>
 <textarea class="span" rows="1" name="noteaccept" id="noteaccept"></textarea>
 </div>
</div>
</div>
<div class="modal-footer">
					<a href="#" class="btn" onclick="acceptCallOff(0);">No Accept</a>
					<a href="#" class="btn btn-primary" onclick="acceptCallOff(1);">Accept</a>
</div>
</div>

<script>
var sid=-1;var ce=null;
var ShowCallOff=function(e){
  ce=e;   
  var t=$(e);
  var f=$("#frmShowCallOff");
  f.find("#username").html(t.html());
  f.find("#note").html(t.attr("notecalloff"));
  sid=t.attr("sid");
  f.modal('show');
    return false; 
}

var acceptCallOff=function(isaccept){
 var data={};
   var url="<?php echo Yii::app()->controller->createUrl('AcceptCallOff') ;?>";
  data.sid=sid;data.isaccept=isaccept; data.noteaccept=$("#frmShowCallOff").find("#noteaccept").val();
   $.post(url,data,function(revalue){
    $("#frmShowCallOff").modal('hide');
    if(revalue=="ok"){
      $(ce).remove();
      loadEvent();
    }
   });    
};
</script>
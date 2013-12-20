<?php
$this->breadcrumbs=array(
	$this->module->id,
);

$this->menu=array(
	array('label'=>'Manage Templates', 'url'=>array('template/index')),
	array('label'=>'Manage Queue', 'url'=>array('queue/index')),
	array('label'=>'Manage Lists', 'url'=>array('list/index')),
);
?>
<h3>Mailer Dashboard</h3>
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>Infomation</th>
			<th>Value</th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td>Templates in database:</td>
		<td><?php echo SimpleMailerTemplate::model()->count(); ?></td>
	</tr>
	<tr>
		<td>Mails sent today:</td>
		<td><?php echo SimpleMailerQueue::getSentCount(); ?></td>
	</tr>
	<tr>
		<td>Mails not sent (still in queue):</td>
		<td><?php echo SimpleMailerQueue::getNotSentCount(); ?></td>
	</tr>
	</tbody>
</table>

<div>

<div class="progress progress-info" id="displayprogress">
  <div class="bar" id="progress"  style="width: 0%">0%</div>
</div>

<button id="cronemail" class="btn btn-primary">Delivery of mails in the queue</button>

</div>

<script>

var total=<?php echo SimpleMailerQueue::getNotSentCount(); ?>;
var limit=<?php echo Yii::app()->getModule('simpleMailer')->sendEmailLimit ?>;
var sentitem=0;
//console.log(total);
//console.log(sentitem);
//console.log("---");

$(document).ready(function(){
   $("#displayprogress").hide() 
   
  $("#cronemail").click(function(){
    if(total==0) return ;
    $("#displayprogress").show()
    $(this).hide();
     cronemail();
     return false;
  }); 
});

var updateInfo=function(data){
 //console.log(sentitem);
 var p=(sentitem/total)*100;
 p=p.toFixed();
 if(sentitem>total) p=100;    
 $('#progress').html(p+'%');
 $('#progress').css("width",p+'%');
 sentitem +=limit;
}

var cronemail=function(){
    var url="<?php echo Yii::app()->controller->createUrl("cronsendemail")?>";
    $.post(url,null,function(data){
      if(data.continue){
       updateInfo(data);
        cronemail();
      } else {
      updateInfo(data);   
      $("#cronemail").removeClass("loading");
      } 
    },'Json');        
}
</script>


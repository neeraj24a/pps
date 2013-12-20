<?php
	$listcalloff =Schedule::model()->findAll("calloff=1");
?>
<?php if (count($listcalloff) >0 ) { ?>
<div  class="well">
<h5>Requests for off</h5>
<?php 
    foreach($listcalloff as $value):  ?>
    <div class="row-fluid ">
    <a class="calloflink"  href="#" sid="<?php echo $value->id;?>" onclick=" ShowCallOff(this); return false;"  notevalue="<?php echo $value->notecalloff ?> ">
    <?php echo  $value->username.":".$value->date;?>
     </a>
    </div>
<?php endforeach; ?>
</div>

<?php }?>

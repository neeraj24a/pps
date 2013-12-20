<a href="#" class=" pull-right" onclick=" ajaxUpdatePart('uonlie-grid'); "><i class="icon-refresh"></i> Refresh</a>
<div id="uonlie-grid" class="grid-view ">
<?php
   
    foreach ($data as $item){
        if($item->eType!=='AdministratorLink')
        $gData[$item->eType][$item->iNodeID]=$item;
    }
    
	foreach ($gData as $k=>$d){
	 //  echo $k."</br>";
       echo " <span class='label label-info'>".$k."</span> "."</br>" ; 
     foreach ($gData[$k] as $item){  
	  if(isset($item))
       echo " <span class='label label-success'>".$item->sName ."</span> ";
	}
     echo "</br>";
    }
?>
</div>

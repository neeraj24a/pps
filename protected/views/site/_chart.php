

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto">
</div>
</div>

<?php

$title="Survey Data: ";

if(isset($dr)){
 $ar= explode('-',$dr->DataR);
 if($ar[0]==$ar[1])
    $title .= $ar[0];
 else $title .= $dr->DataR;    
}

//fix data 
$total=0;
foreach ($chartdata as $item){
$total +=$item['Count'];
}
$data=array();
$Totalv=0;
$i=0;

foreach ($chartdata as $item){
if($i == (count($chartdata)-1))
$v= 100-$Totalv;
else 
$v = round($item['Count']*100/$total,1);

$Totalv +=$v;
if($item['Rate']==1){
  $data[]=array('name'=>Survey::getRateSurvey($item['Rate']).' ('.$item['Count'].')','y'=>$v, 'sliced'=>true,'selected'=>true,'color'=>'red' );  
} else   
    {
     $c="";   
     if($item['Rate']==4)
     $c="green";
     if($item['Rate']==2)
     $c="yellow";
     if($item['Rate']==3)
     $c="blue";     
     $data[]=array('name'=>Survey::getRateSurvey($item['Rate']).' ('.$item['Count'].')','y'=>$v,'color'=>$c);
    }
$i +=1;    
}


 $this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
      'chart'=> array(
            'renderTo'=>'container',
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> false
        ),
        'title' => array('text' => $title),
        'tooltip'=>array(
                'formatter'=>'js:function() { return "<b>"+ this.point.name +"</b>: "+ this.percentage +" %"; }'
                     ),
        'plotOptions'=>array(
            'pie'=>array(
                'allowPointSelect'=> true,
                'cursor'=>'pointer',
                'dataLabels'=>array(
                    'enabled'=> true,
                    'color'=>'#000000',
                    'connectorColor'=>'#000000',
                    'formatter'=>'js:function() { return "<b>"+ this.point.name +"</b>:"+this.percentage +" %"; }'  
 
                                   )
                        )
                 ),
 
      'series' => array(
                 array('type'=>'pie','name' => 'Browser share ', 
                    'data' =>$data),
 
              )
           )
        ));
 
?>
<?php
/**

//define variables
$sEmail = "jose@test.com";
$sPassword = "Password1";
$sBeginDate = "2013/02/20";				//define this with your own data
$sEndDate = "2013/02/20";			//define this appropraitely based on your data
$eReportArea = "SESSION";
$iNodeID = "862904309";
$eNodeRef = "CHANNEL";

//define parameters
$loginparams = array (
'sEmail' => $sEmail,
'sPassword' => $sPassword);


$ws= new Logmein();
$l=$ws->login($loginparams);



//switch to XML for easier formatting of output
$output = array(
'eOutput' => "XML"
);

$outputResponse = $ws->setOutput($output);

//set up array for getSession
$sessionparams = array(
'iNodeID' => $iNodeID,
'eNodeRef' => $eNodeRef
);

//get session(s)
$sessionresult = $ws->getSession($sessionparams);

var_dump($sessionresult);

die();


//set the report area
//define parameters
$reportareaarams = array (
'eReportArea' => $eReportArea
);

//set the time frame
$reportDateParams= array(
'sBeginDate' => $sBeginDate,
'sEndDate' => $sEndDate
);

$a=$ws->setReportArea($reportareaarams);


$d=$ws->setReportDate($reportDateParams);


//finally, get the report
//set up array
$getReportParams = array(
'iNodeID' => $iNodeID,
'eNodeRef' => $eNodeRef
);

$getReportResponse= $ws->getReport($getReportParams);

$reportdata = explode("\n",$getReportResponse->sReport);


foreach($reportdata as $key => $val) {
    if($key == 0) {
    $COLUMN = explode ("|",$val);
}

$COLDATA = explode("|",$val);

foreach($COLDATA as $ckey => $val) { 
    if(empty($COLUMN[$ckey])) {
    $COLUMN[$ckey] = $ckey;
} else {
    $COLUMN[$ckey] = str_replace( " ","",$COLUMN[$ckey]);
}
  $REPORT[$key][$COLUMN[$ckey]] = $val;
 }
}

var_dump($REPORT);


 */
?>
<?php

//define variables
$sEmail = "jose@test.com";
$sPassword = "Password1";
$sBeginDate = "2013/02/20";				//define this with your own data
$sEndDate = "2013/02/20";			//define this appropraitely based on your data
$eReportArea = "SESSION";
$iNodeID = "862904309";
$eNodeRef = "CHANNEL";
//$iNodeID = "718535";
//$eNodeRef = "NODE";

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


?>

<?php

$title="";

if(isset($dr)){
 $ar= explode('-',$dr->DataR);

} 

$name = array();
$series=array();
$data=array();
$xAxis=array();
$survey=$chartdata['survey'];
foreach ($survey as $item){
  $name[$item['mName']]=array(trim($item['mName']));
  $data[$item['mName']][$item['Rate']]= $item['Count'] ;
}

foreach ($name as $i){
  $xAxis[]=$i;
}

$list=Survey::getRateSurvey();
ksort($list);
 foreach($list as $i=>$j){
    $item = array();
  $item['name']=$j;
   
  $d=array();
  foreach($xAxis as $g){
    if(isset($data[$g[0]][$i]))
    $d[]=$data[$g[0]][$i]*1;
  else $d[]=0;
  }
    $c="";   
     if($i==1)
     $c="red";
     if($i==4)
     $c="green";
     if($i==2)
     $c="yellow";
     if($i==3)
     $c="blue";     
    $item["color"]  =$c;
     
  $item["data"]=$d;
  $series[]=$item;
 }

//var_dump($series);
//die();

$this->Widget('ext.highcharts.HighchartsWidget',
        array(
            'id' => 'SurveysBar',
            'options'=> array(
                'chart' => array(
                     'type'=>'column',
                    'style' => array(
                        'fontFamily' => 'Verdana, Arial, Helvetica, sans-serif',
                    ),
                ),
                'title' => array(
                    'text' => $title,
                ),
                'xAxis' => array(
                    'title' => array(
                    'text' => "$this->comp",
                    ),
               'categories' => $xAxis,
                    'labels' => array(
                        'step'     => 1,
                        'style'=>array(
                        'fontSize'=>'12px',
                        'fontFamily'=>'Verdana, sans-serif'
                    )
                    ),
                ),
                'yAxis' => array(
                    'min'=>0,
                    'title' => array(
                        //'text' => "Session $this->comp",
                    ),
                    'stackLabels'=>array(
                    'enabled'=>true,
                    ),
                    
                ),
                 'plotOptions'=> array(
                    'column'=>array(
                        'stacking'=> 'normal',
                        'dataLabels'=>array(
                            'enabled'=>false
                                )
                        )
                ),
               'tooltip'=>array(
                'pointFormat'=>'<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage}%)<br/>',
                'percentageDecimals'=>1,
                'shared'=>true
            ),
               
                'legend'=> array(
                'layout'=>'horizontal',
                 
                ),
                 'series' => $series
            )
        )
    );
?>
<style>
#sessionchartMonth{
     width: 80% !important;
     
}
</style>

<?php
$title="";

//if(isset($dr)){
 //$ar= explode('-',$dr->DataR);
 
 $xAxis = array();
//$sessions=$chartdata['sessions'];
 $series=array();
 $data=array();
foreach ($model as $item){
  //  var_dump($item);
  $xAxis[]=array(trim($item['TechName']));
  $data['Excellent'][]=$item['Excellent']*1;  
  $data['Good'][]=$item['Good']*1;
  $data['Mediocre'][]=$item['Mediocre']*1;
  $data['Disappointing'][]=$item['Disappointing']*1;
  //$series[]=$item['Total']*1;
}

if(!isset($data['Disappointing'])) { $data['Disappointing']=0;}
if(!isset($data['Mediocre'])) { $data['Mediocre']=0;}
if(!isset($data['Good'])) { $data['Good']=0;}
if(!isset($data['Excellent'])) { $data['Excellent']=0;}

$series[]=array('name'=>"Disappointing",'data'=>$data['Disappointing'],'color'=>'red');
$series[]=array('name'=>"Mediocre",'data'=>$data['Mediocre'],'color'=>'yellow');
$series[]=array('name'=>"Good",'data'=>$data['Good'],'color'=>'blue');
$series[]=array('name'=>"Excellent",'data'=>$data['Excellent'],'color'=>'green');

  
//}

 $this->Widget('ext.highcharts.HighchartsWidget',
        array(
            'id' => 'sessionchartMonth',
            'options'=> array(
                'chart' => array(
                    'type'=>'column',
                    'class'=>'span',
                    'style' => array(
                        'fontFamily' => 'Verdana, Arial, Helvetica, sans-serif',
                        
                    ),
                ),
                'title' => array(
                    //'text' => $title,
                ),
                'xAxis' => array(
                    'title' => array(
                       //'text' => "$this->comp"  
                    ),
               'categories' => $xAxis,
                    'labels' => array(
                        'step'     => 0,
                        'rotation'=>-90,
                        'y'=>40,
                        'style'=>array(
                        'fontSize'=>'13px',
                        'fontFamily'=>'Verdana, sans-serif'
                    )
                    ),
                ),
                'yAxis' => array(
                    'min'=>0,
                    'title' => array(
                        //'text' => 'Sessions',
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
                 /*
                 array(
                    array(
                        'name'   => "Sessions "  ,
                        'data'   => $series,
                        'shadow' => false,
                        
                        'dataLabels'=>array(
                        'enabled'=>false,
                       // 'color'=>'#468847',
                        'align'=>'right',
                        'x'=>25,
                        'style'=>array(
                        'fontSize'=>'9px',
                        'fontFamily'=>'Verdana, sans-serif'
                        )
                      )
                    )
                ) */
            )
        )
    );
?>

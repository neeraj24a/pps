
<?php

$title="";

if(isset($dr)){
 $ar= explode('-',$dr->DataR);
 
 $xAxis = array();
$sessions=$chartdata['sessions'];
 $series=array();
foreach ($sessions as $item){
  $xAxis[]=array(trim($item['mName']));  
  $series[]=$item['Count']*1;
}
  
}

	$this->Widget('ext.highcharts.HighchartsWidget',
        array(
            'id' => 'sessionchartMonth',
            'options'=> array(
                'chart' => array(
                     'type'=>'column',
                    'style' => array(
                        'fontFamily' => 'Verdana, Arial, Helvetica, sans-serif',
                    ),
                ),
                'title' => array(
                    //'text' => $title,
                ),
                'xAxis' => array(
                    'title' => array(
                        'text' => "$this->comp"  
                    ),
               'categories' => $xAxis,
                    'labels' => array(
                        'step'     => 1,
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
                            'enabled'=>true
                                )
                        )
                ),
              
               
                'legend'=> array(
                'layout'=>'horizontal',
                ),
                 'series' => array(
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
                )
            )
        )
    );
?>
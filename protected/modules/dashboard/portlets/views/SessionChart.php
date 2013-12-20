
<div id="sessionchart" style="width: auto; margin: 0px auto ; padding: 0px;">
</div>

<?php

$title="";

if(isset($dr)){
 $ar= explode('-',$dr->DataR);
 if($ar[0]==$ar[1])
    $title .= $ar[0];
 else $title .= $dr->DataR;    
}

$data=array();

 $xAxis = array();
 $yAxis = array();
    
foreach ($chartdata as $item){
  $xAxis[]=array(trim($item['TechName']));  
  $yAxis[]=$item['Count']*1;
}

$this->Widget('ext.highcharts.HighchartsWidget',
        array(
            'id' => 'something',
            'options'=> array(
                'chart' => array(
                    'defaultSeriesType' => 'column',
                    'type'=>'bar',
                    'height'=>'600',
                    'style' => array(
                        'fontFamily' => 'Verdana, Arial, Helvetica, sans-serif',
                    ),
                ),
                'title' => array(
                    'text' => $title,
                ),
                'xAxis' => array(
                    'title' => array(
                     //  'text' => 'Technician',
                    ),
                    'categories' => $xAxis,
                    'labels' => array(
                        'step'     => 1,
                       // 'rotation' => 90,
                      //  'y'        => 40,
                        'style'=>array(
                        'fontSize'=>'13px',
                        'fontFamily'=>'Verdana, sans-serif'
                    )
                    ),
                ),
                'yAxis' => array(
                    'title' => array(
                        'text' => 'Sessions',
                    ),
                ),
                 'plotOptions'=> array(
                'column'=>array('pointPadding'=> 0.1,
                    "borderWidth"=> 0)
                ),
                       
                                        
                'series' => array(
                    array(
                        'name'   => 'Session',
                        'data'   => $yAxis,
                        'shadow' => false,
                        
                        'dataLabels'=>array(
                        'enabled'=>true,
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


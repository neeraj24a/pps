<div id="container" style="width: a auto; margin: 0 auto"></div>
<?php
$title="";
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
foreach ($chartdata as $item){

$v = $item['Count']*100/$total;
//$Totalv +=$v;

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
   
}


 $this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
      'chart'=> array(
            'renderTo'=>'container',
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> true,
            'height'=>'550'
        ),
        'title' => array(
        //'text' => $title
        ),
        'subtitle' => array('text' => $title),
        'tooltip'=>array(
                'formatter'=>'js:function() { return "<b>"+ this.point.name + "</b>: "+ Highcharts.numberFormat(this.percentage,2) +" %"; }'
                     ),
        'plotOptions'=>array(
            'pie'=>array(
                'allowPointSelect'=> true,
                'cursor'=>'pointer',
                'dataLabels'=>array(
                    'enabled'=> true,
                    'color'=>'#000000',
                    'connectorColor'=>'#000000',
                    'formatter'=>'js:function() { return  "<b>" + this.point.name + "</b><br>" + Highcharts.numberFormat(this.percentage,2) +" %"; }'  
                                   )
                        )
                 ),
 
      'series' => array(
                 array(
                 'type'=>'pie',
                 'name' => 'Browser share ', 
                  'data' =>$data,
                        'dataLabels'=>array(
                        'enabled'=>true,
                        'rotation'=>-90,
                        //'color'=>'#DDFDFD',
                        //'align'=>'c',
                   //  'x'=>4,
                      //  'y'=>10,
                        'style'=>array(
                        'fontSize'=>'10px',
                        'fontFamily'=>'Verdana, sans-serif'
                        )
                      )                  
                  ),
 
              )
           )
        ));
 
?>

<?php
$sysformat=array(
     'booleanFormat'=>array('Không','Có'),
     'datetimeFormat'=>'d/m/Y H:i:s',
     'dateFormat'=>'d-m-Y',
     'numberFormat'=>array('decimals'=>0, 'decimalSeparator'=>',', 'thousandSeparator'=>'.'),
     );
$params=array(
    'adminEmail'=>'webmaster@example.com',
);

function yiiparam($name, $default = null)
{
    if ( isset(Yii::app()->params[$name]) )
        return Yii::app()->params[$name];
    else
        return $default;
}
<?php
/*
'db'=>array(
'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
),
*/

// uncomment the following to use a MySQL database

$db1= array(
    'connectionString' => 'mysql:host=localhost;dbname=tecnotic_rpps',
    'username' => 'tecnotic_rpps',
    'password' => 'rpps123456',
    'emulatePrepare' => true,
    'charset' => 'utf8',
    'tablePrefix'=>'tbl_',
    'enableProfiling'=>true,
    'enableParamLogging'=>true,
);

$db= array(
    'connectionString' => 'mysql:host=127.0.0.1;dbname=pps11',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'tablePrefix'=>'tbl_',
    'enableProfiling'=>true,
    'enableParamLogging'=>true,
);
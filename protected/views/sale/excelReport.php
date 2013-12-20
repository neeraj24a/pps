<?php

$dialog = $this->widget('ext.ecolumns.EColumnsDialog', array(

       'options'=>array(

            'title' => 'Layout settings',

            'autoOpen' => false,

            'show' =>  'fade',

            'hide' =>  'fade',

        ),

       'htmlOptions' => array('style' => 'display: none'), //disable flush of dialog content

     'ecolumns' =>array(

            'gridId' => 'customerlog-grid', //id of related grid

            'storage' => 'db',  //where to store settings: 'db', 'session', 'cookie'

            'fixedLeft' => array('CCheckBoxColumn'), //fix checkbox to the left side 

            'model' => $dataProvider->model, //model is used to get attribute labels

            'columns' =>

            array(

                    'Name',
                    'Email',
                    'Phone',
                    'CreateDate',
                   array('name'=>'Rate',
                    'value'=>'$data->rate_text',
                    ),

                    array('name'=>'Status',
                    'value'=>'$data->status_text',
                    ),

                   'Comment',

                     ))));

                     

	

$properties = array(

    'id' => $this->action->id .'-grid',

    'dataProvider' => $dataProvider,

    'grid_mode'=>'export',

    'title'                => 'Custumers - ' . date('d-m-Y - H-i-s'),

    //'creator'              => 'Your Name',

    //'subject'              => mb_convert_encoding('Something important with a date in French: ' . utf8_encode(strftime('%e %B %Y')), 'ISO-8859-1', 'UTF-8'),

    //'description'          => mb_convert_encoding('Etat de production généré à la demande par l\'administrateur (some text in French).', 'ISO-8859-1', 'UTF-8'),

   // 'lastModifiedBy'       => 'Some Name',

    'sheetTitle'           => 'Report on ' . date('m-d-Y H-i'),

   // 'keywords'             => '',

   // 'category'             => '',

   // 'landscapeDisplay'     => true, // Default: false

    //'A4'                   => true, // Default: false - ie : Letter (PHPExcel default)

    'pageFooterText'       => '&RThis is page no. &P of &N pages', // Default: '&RPage &P of &N'

    'automaticSum'         => true, // Default: false

    'decimalSeparator'     => ',', // Default: '.'

    'thousandsSeparator'   => '.', // Default: ','

    //'displayZeros'       => false,

    //'zeroPlaceholder'    => '-',

   /* 'sumLabel'             => 'Column totals:', // Default: 'Totals'

    'borderColor'          => '00FF00', // Default: '000000'

    'bgColor'              => 'FFFF00', // Default: 'FFFFFF'

    'textColor'            => 'FF0000', // Default: '000000'

    'rowHeight'            => 45, // Default: 15

    'headerBorderColor'    => 'FF0000', // Default: '000000'

    'headerBgColor'        => 'CCCCCC', // Default: 'CCCCCC'

    'headerTextColor'      => '0000FF', // Default: '000000'

    'headerHeight'         => 10, // Default: 20

    'footerBorderColor'    => '0000FF', // Default: '000000'

    'footerBgColor'        => '00FFCC', // Default: 'FFFFCC'

    'footerTextColor'      => 'FF00FF', // Default: '0000FF'

    'footerHeight'         => 50, // Default: 20

   */ 

    'columns'=>$dialog->columns(),

);





            



$this->widget('application.widgets.tlbExcelView', $properties);
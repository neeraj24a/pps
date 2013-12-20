<?php
	 $this->widget('application.extensions.fullcalendar.FullcalendarGraphWidget', 
                array(
                    'data'=> $listeven,
                    'id'=>'calendar',
                    'options'=>array(
                    'theme'=> false,
                    'header' => array(
                        'left' => 'month,agendaWeek,agendaDay',
                        'center' => 'title',
                        'right' => 'today ,prev,next',
                    ),
                    //'isRTL' => true, //Displays the calendar right-to-left(true) or left-to-right(default:false)
                    //'weekends' => false, //Displays the satuday and sunday in calendar (true: display or false: hidden)
                    //'height' => '600', //Will make the entire calendar (including header) a pixel height.
                    //'contentHeight' => '400', //Will make the calendar's content area a pixel height.
                    //'viewDisplay'=>'js:function(view){attachBehaviorsViewDisplayCal(view)}',
                    'timeFormat'=> '',
                    'minTime'=>'6:00',
                    'maxTime'=>'23:00',
                    
                    'aspectRatio' => '1.8', //Determines the width-to-height aspect ratio of the calendar.
                    //'firstDay' => '1', //The day that each week begins -> Sunday=0, Monday=1, Tuesday=2, etc.
                    'editable'=>false,
                    'droppable'=>false,
                    'disableResizing'=>false,
                    'disableDragging'=>false,
                   /* 'view'=>array(
                        'visStart' =>yii::app()->dateFormatter->format('y-MM-dd',$plan->startdate),
                        'visEnd' => yii::app()->dateFormatter->format('y-MM-dd',$plan->enddate),
                        'start' => yii::app()->dateFormatter->format('y-MM-dd',$plan->startdate),
                        'end' => yii::app()->dateFormatter->format('y-MM-dd',$plan->enddate),
                    ),*/
                   // 'month'=>((int)yii::app()->dateFormatter->format('MM',$plan->startdate)-1),
                  //  'day'=>(int)yii::app()->dateFormatter->format('dd',$plan->startdate),
                  //  'year'=>(int)yii::app()->dateFormatter->format('y',$plan->startdate),
                    /*
                    'start'=> date('Y-m-d',strtotime($plan->startdate)),
                    'end'=> date('Y-m-d',strtotime($plan->enddate)),
                    'visStart'=>date('Y-m-d',strtotime($plan->startdate)),
                    'visEnd'=>date('Y-m-d',strtotime($plan->enddate)),*/
                    'defaultView'=>'month', //month ,basicWeek, basicDay, agendaWeek, agendaDay
                    //'allDaySlot' => false, //When hidden with false, all-day events will not be displayed in agenda views.
                //Text/Time Customization -> http://arshaw.com/fullcalendar/docs/text/timeFormat/
                    'columnFormat' => array( //Determines the text that will be displayed on the calendar's column headings.
                        'month' => 'ddd',
                        'customer'=>'ddd',    // Mon ->sortDay
                        'week' => 'ddd, d/M', // Mon 31/10
                        'day' => 'dddd, d/M',
         // Monday 31/10 ->fullDay
                    ),
                    'titleFormat' => array( //Determines the text that will be displayed in the header's title.
                        'month' => 'MMMM yyyy',                             // September2009
                        'week'=> "MMMM d[ yyyy]{ '&#8212;'[ MMM] d  yyyy}", // 7 - 13 Sep 2009
                        'day' => 'dddd, yyyy/MMM/d',                  // Tuesday, 8 Sep, 2009
                    ),
                    'monthNamesShort' => array(  //Abbreviated names of months.
                        '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'
                    ),
                    'eventRender'=>'js:function(event, element){addDescription(event, element)}',  
                ),
                    'htmlOptions'=>array(
                           'style'=>'width:100%;margin: 0 auto;'
                    ),
                )
            );
?>
<?php

// this is how to use the dateRange helpers in your view
/* 
$this->widget('zii.widgets.grid.CGridView', array(
    'afterAjaxUpdate' => Help::dateRangeInitJs(),
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        Help::dateRangeCol($model, 'dateAttr', array('header' => 'The date')),
    ),
));
*/
class Help {
// since the code above uses the methods from class Help, the following could go
// in a CComponent called Help in a file named Help.php in protected/components 

    /**
     * Define jQuery UI DatePicker Widget options here.
     * @see http://jqueryui.com/demos/datepicker/
     * @static
     * @return array
     */
    private static function _dateRangeOptions() {
        return array(
            'changeMonth' => true,
            'dateFormat' => 'dd/mm/y',
            'changeMonth' => 'true',
            'changeYear' => 'true',
            'constrainInput' => 'false',
            'showAnim' => 'fade',
        );
    }

    /**
     * Creates a JS function that initializes dateRangeCol datePickers
     * @static
     * @return string a string you can assign to CGridView::$afterAjaxUpdate
     */
    public static function dateRangeInitJs() {
        return 'function () {
            jQuery("tr.filters input.date-range").datepicker('
            . CJavaScript::encode(self::_dateRangeOptions())
            . ');
        }';
    }

    /**
     * Creates a CGridView column specification for a date column with range filter
     * @static
     * @param CActiveRecord $model where the CGV's data is coming from
     * @param string $attr name of attr corresponding to this column
     * @param array $opts column options
     * @return array a column spec you can initialize CDataColumn with
     */
    public static function dateRangeCol($model, $attr, $opts = array()) {
        // get rid of this and the following if block if you don't want this helper
        // to publish your custom jui theme
        static $published;
        if (!$published) {
            $am = Yii::app()->assetManager;
            $juiCssBase = $am->publish(
                Yii::getPathOfAlias('ext') . '/jquery-ui-custom/css/custom-theme'
            );
            $juiJqUrl = $am->publish(
                Yii::getPathOfAlias('ext')
                . '/jquery-ui-custom/js/jquery-ui-1.8.17.custom.min.js'
            );
            $cs = Yii::app()->clientScript;
            $cs->scriptMap = array('jquery.ui' => $juiJqUrl);
            $cs->registerCssFile($juiCssBase . '/jquery-ui-1.8.17.custom.css');
            $cs->registerScriptFile($juiJqUrl);
            $published = true;
            $published = true;
        }

        static $controller;
        if (!$controller)
            $controller = new CController('HelpController');
        return $opts + array(
            'name' => $attr,
            // this uses my date formatter. change it to what you want
            'value' => 'Help::fDate($data->' . $attr . ', "short")',
            'type' => 'raw',
            'filter' =>
            $controller->widget('zii.widgets.jui.CJuiDatePicker',
                array(
                    'model' => $model,
                    'attribute' => $attr . '_range_from',
                    'cssFile' => false,
                    'scriptFile' => false,
                    'options' => self::_dateRangeOptions(),
                    'htmlOptions' => array(
                        'id' => get_class($model) . '_' . $attr . '_range_from',
                        'class' => 'date-range',
                    ),
                ),
                true
            )
            . '<br>' .
            $controller->widget('zii.widgets.jui.CJuiDatePicker',
                array(
                    'model' => $model,
                    'attribute' => $attr . '_range_to',
                    'cssFile' => false,
                    'scriptFile' => false,
                    'options' => self::_dateRangeOptions(),
                    'htmlOptions' => array(
                        'id' => get_class($model) . '_' . $attr . '_range_to',
                        'class' => 'date-range',
                    ),
                ),
                true
            ),
        );
    }
}
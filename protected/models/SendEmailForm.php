<?php

/**
 * SurveyForm class.
 * SurveyForm is the data structure for keeping
  */
class SendEmailForm extends CFormModel
{
	public $template_name;
	public $list_name;
    public $ids;

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'template_name'=>"Select email template",
            'list_name'=>"Send to list",
            'ids'=>"ids"
		);
	}

}

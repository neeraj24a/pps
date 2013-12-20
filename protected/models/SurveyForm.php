<?php

/**
 * SurveyForm class.
 * SurveyForm is the data structure for keeping
  */
class SurveyForm extends CFormModel
{
	public $status;
	public $rate;
	public $comment;


	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'status'=>"What's the status of your problem?",
            'rate'=>"Please rate your remote support experience.",
            'comment'=>"Any additional comments?"
		);
	}

}

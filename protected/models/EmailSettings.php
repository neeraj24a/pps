<?php

/**
 * EmailSettings class.
 * EmailSettings is the data structure for keeping
  */
class EmailSettings extends CFormModel
{
	public $emails;
   	public $emailtoCus;

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'emails'=>"Emails",
            'emailtoCus'=>"Email",
		);
	}

}

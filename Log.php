<?php

class Log
{
	public $dateTime;
	public $type;
	public $content;

	function __construct($dateTime, $type, $content)
	{
		$this->dateTime = $dateTime;
		$this->type = $type;
		$this->content = $content;
		$this->setDateTimeInIso8601();
	}

	public function setDateTimeInIso8601()
	{
		$dateTime = new DateTime($this->dateTime);
		$this->dateTime = $dateTime->format(DateTime::ATOM);
	}
}

?>
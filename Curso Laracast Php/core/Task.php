<?php 

class Task {

	public $description;
	public $completed;

	// public function __construct($description)
	// {
	// 	$this->description = $description;    //$this se refere à classe Task
	// }
	
	public function isComplete()
	{
		return $this->completed;
	}

	public function complete()
	{
		$this->completed = true;
	}

}
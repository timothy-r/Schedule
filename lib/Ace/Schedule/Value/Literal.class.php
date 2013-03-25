<?php
namespace Ace\Schedule\Value;

class Literal implements iValue {
	protected $value;	
	public function __construct($value){
		$this->value = intval($value);
	}

	public function contains($value){
		return $this->value == $value;
	}
}


<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\iValue;

/**
* contains a range of discrete values
*/
class AList implements iValue {
	protected $values;	
	public function __construct(array $values){
		$this->values = $values;
	}

	public function contains($value){
		return in_array($value, $this->values);
	}
}


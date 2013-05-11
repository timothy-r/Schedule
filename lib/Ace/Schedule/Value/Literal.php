<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\iValue;

class Literal implements iValue {
	protected $value;

	public function __construct($value){
		$this->value = intval($value);
	}

	public function contains($value){
		return $this->value == $value;
	}

    public function min()
    {
        return $this->value;
    }

    public function max()
    {
        return $this->value;
    }
}


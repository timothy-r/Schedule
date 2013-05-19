<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\IValue;

/**
* contains a single value
*/
class Literal implements IValue {
    /**
    * @var integer
    */
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

    public function greaterThan($value)
    {
        return ($this->value > $value);
    }

    public function lessThan($value)
    {
        return ($this->value < $value);
    }
}


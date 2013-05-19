<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\IValue;

/**
* contains a list of discrete values
*/
class AList implements IValue {
    /**
    * @var array
    */
	protected $values;

	public function __construct(array $values){
		$this->values = $values;
	}

	public function contains($value){
		return in_array($value, $this->values);
	}

    public function min()
    {
        sort($this->values);
        if (count($this->values)){
            reset($this->values);
            return current($this->values);
        }
        return null;
    }

    public function max()
    {
        rsort($this->values);
        if (count($this->values)){
            reset($this->values);
            return current($this->values);
        }
        return null;
    }

    public function greaterThan($value)
    {
        return $this->max() > $value;
    }

    public function lessThan($value)
    {
        return $this->min() < $value;
    }
}


<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\iValue;

/**
* contains a range of discrete values
*/
class AList implements iValue {
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
}


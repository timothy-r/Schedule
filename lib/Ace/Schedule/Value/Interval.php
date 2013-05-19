<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\IValue;

class Interval implements IValue {
    /**
    * @var IValue
    */
	protected $range;
	protected $interval;

	public function __construct(IValue $range, $interval){
		$this->range = $range;
		$this->interval = intval($interval);
	}

	/**
	* eg 2-46/2 for minutes indicates every 2 mins between 2 and 46
	* starting at 4 (2+2)
	*/
	public function contains($value) {
		$value = intval($value);
		if ($this->range->contains($value)){	
			// inside the range, test if matches the interval
			return 0 == ($value % $this->interval);
		}
		return false;
	}

    public function min()
    {
        return $this->range->min();
    }

    public function max()
    {
        return $this->range->max();
    }

    public function greaterThan($value)
    {
        return $this->range->min() > $value;
    }

    public function lessThan($value)
    {
        return $this->range->max() < $value;
    }
}

<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\ValueInterface;

class Interval implements ValueInterface {
    /**
    * @var ValueInterface
    */
	protected $range;
	protected $interval;

	public function __construct(ValueInterface $range, $interval){
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

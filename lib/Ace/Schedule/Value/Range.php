<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\IValue;

/**
* contains a range of continuous values inclusive of boundaries
*/
class Range implements IValue
{
	protected $low;
	protected $high;

	public function __construct($low, $high)
    {
		$this->low = intval($low);
		$this->high = intval($high);
	}

	public function contains($value)
    {
		$value = intval($value);
		return (($value >= $this->low) && ($value <= $this->high));
	}

    public function min()
    {
		return $this->low;
    }

    public function max()
    {
		return $this->high;
    }

    public function greaterThan($value)
    {
        return $this->low > $value;
    }

    public function lessThan($value)
    {
        return $this->high < $value;
    }
}

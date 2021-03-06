<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\ValueInterface;

/**
* A wild card value matches everything
*/
class WildCard implements ValueInterface
{
	public function contains($value){
		return true;
	}

    public function min()
    {
        return null;
    }

    public function max()
    {
        return null;
    }

    public function greaterThan($value)
    {
        return false;
    }

    public function lessThan($value)
    {
        return false;
    }
}


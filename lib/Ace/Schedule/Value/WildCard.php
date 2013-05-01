<?php
namespace Ace\Schedule\Value;
use Ace\Schedule\iValue;

/**
* A wild card value matches everything
*/
class WildCard implements iValue
{
	public function contains($value){
		return true;
	}
}


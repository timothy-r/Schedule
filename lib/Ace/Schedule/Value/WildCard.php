<?php
namespace Ace\Schedule\Value;
/**
* A wild card value matches everything
*/
class WildCard implements iValue
{
	public function contains($value){
		return true;
	}
}


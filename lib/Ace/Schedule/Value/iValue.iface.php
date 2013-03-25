<?php
namespace Ace\Schedule\Value;

/**
* interface for classes that represent one or more values
*/
interface iValue {
	public function contains($value);
}

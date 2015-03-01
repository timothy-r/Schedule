<?php namespace Ace\Schedule\Test;

use Ace\Schedule\BuilderInterface;
use Ace\Schedule\IValue;
use Ace\Schedule\Entry;

/**
* @codeCoverageIgnore
*/
class StubBuilder implements BuilderInterface
{
	public function buildMinute(IValue $value){}
	public function buildHour(IValue $value){}
	public function buildDay(IValue $value){}
	public function buildMonth(IValue $value){}
	public function buildWeekDay(IValue $value){}
	public function getProduct(){
		return new Entry(array());
	}
}

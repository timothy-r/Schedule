<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\IBuilder;
use Ace\Schedule\IValue;
use Ace\Schedule\Entry;

/**
* @codeCoverageIgnore
*/
class StubBuilder implements IBuilder
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

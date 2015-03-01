<?php namespace Ace\Schedule\Test;

use Ace\Schedule\BuilderInterface;
use Ace\Schedule\ValueInterface;
use Ace\Schedule\Entry;

/**
* @codeCoverageIgnore
*/
class StubBuilder implements BuilderInterface
{
	public function buildMinute(ValueInterface $value){}
	public function buildHour(ValueInterface $value){}
	public function buildDay(ValueInterface $value){}
	public function buildMonth(ValueInterface $value){}
	public function buildWeekDay(ValueInterface $value){}
	public function getProduct(){
		return new Entry(array());
	}
}

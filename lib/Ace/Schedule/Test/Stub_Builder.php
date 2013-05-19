<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\IBuilder;
use Ace\Schedule\IValue;

/**
* @codeCoverageIgnore
*/
class Stub_Builder implements IBuilder
{
	public function buildMinute(IValue $value){}
	public function buildHour(IValue $value){}
	public function buildDay(IValue $value){}
	public function buildMonth(IValue $value){}
	public function buildWeekDay(IValue $value){}
	public function getMatchers(){
		return array();
	}
    public function createWildCard(){}
    public function createLiteral($value){}
    public function createAList(array $value){}
    public function createRange($min, $max){}
    public function createInterval(IValue $value, $interval){}
}

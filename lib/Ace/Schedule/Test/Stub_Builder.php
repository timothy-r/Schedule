<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\IBuilder;
use Ace\Schedule\iValue;

/**
* @codeCoverageIgnore
*/
class Stub_Builder implements IBuilder
{
	public function buildMinute(iValue $value){}
	public function buildHour(iValue $value){}
	public function buildDay(iValue $value){}
	public function buildMonth(iValue $value){}
	public function buildWeekDay(iValue $value){}
	public function getMatchers(){
		return array();
	}
    public function createWildCard(){}
    public function createLiteral($value){}
    public function createAList(array $value){}
    public function createRange($min, $max){}
    public function createInterval(iValue $value, $interval){}
}

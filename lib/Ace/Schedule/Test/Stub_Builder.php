<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\iBuilder;

class Stub_Builder implements iBuilder
{
	public function buildMinute($value){}
	public function buildHour($value){}
	public function buildDay($value){}
	public function buildMonth($value){}
	public function buildWeekDay($value){}
	public function getMatchers(){
		return array();
	}
    public function createWildCard(){}
    public function createLiteral($value){}
    public function createAList(array $value){}
    public function createRange($min, $max){}
    public function createInterval($min, $max, $interval){}
}

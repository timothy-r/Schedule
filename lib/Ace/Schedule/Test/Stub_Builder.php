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
}

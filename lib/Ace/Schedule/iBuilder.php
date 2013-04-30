<?php
namespace Ace\Schedule;

/**
* interface to create specific iMatcher types
*/
interface iBuilder
{
	public function buildMinute($value);
	public function buildHour($value);
	public function buildDay($value);
	public function buildMonth($value);
	public function buildWeekDay($value);
}

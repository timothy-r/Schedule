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
	/**
	* @return array of iMatcher instances
	*/
	public function getMatchers();

    public function createWildCard();
    public function createLiteral($value);
    public function createAList(array $value);
    public function createRange($min, $max);
    public function createInterval($min, $max, $interval);
}

<?php
namespace Ace\Schedule;

/**
* interface to create specific iMatcher types
*/
interface IBuilder
{
	public function buildMinute(iValue $value);
	public function buildHour(iValue $value);
	public function buildDay(iValue $value);
	public function buildMonth(iValue $value);
	public function buildWeekDay(iValue $value);

	/**
	* @return array of iMatcher instances
	*/
	public function getMatchers();

    /**
    public function createWildCard();
    public function createLiteral($value);
    public function createAList(array $value);
    public function createRange($min, $max);
    public function createInterval(iValue $value, $interval);
    **/
}

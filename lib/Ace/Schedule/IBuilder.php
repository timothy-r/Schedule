<?php
namespace Ace\Schedule;

/**
* interface to create specific IMatcher types
*/
interface IBuilder
{
	public function buildMinute(IValue $value);
	public function buildHour(IValue $value);
	public function buildDay(IValue $value);
	public function buildMonth(IValue $value);
	public function buildWeekDay(IValue $value);

	/**
	* @return array of IMatcher instances
	*/
	public function getMatchers();

    /**
    public function createWildCard();
    public function createLiteral($value);
    public function createAList(array $value);
    public function createRange($min, $max);
    public function createInterval(IValue $value, $interval);
    **/
}

<?php
namespace Ace\Schedule;

/**
* interface to create specific IMatcher types
* @todo add buildYear() method
*/
interface IBuilder
{
	public function buildMinute(IValue $value);
	public function buildHour(IValue $value);
	public function buildDay(IValue $value);
	public function buildMonth(IValue $value);
	public function buildWeekDay(IValue $value);

	/**
	* @return Entry
	*/
	public function getProduct();
}

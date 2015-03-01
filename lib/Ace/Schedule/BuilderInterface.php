<?php
namespace Ace\Schedule;

/**
* interface to create specific MatcherInterface types
* @todo add buildYear() method
*/
interface BuilderInterface
{
	public function buildMinute(ValueInterface $value);
	public function buildHour(ValueInterface $value);
	public function buildDay(ValueInterface $value);
	public function buildMonth(ValueInterface $value);
	public function buildWeekDay(ValueInterface $value);

	/**
	* @return Entry
	*/
	public function getProduct();
}

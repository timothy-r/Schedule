<?php
namespace Ace\Schedule;
use Ace\Schedule\IBuilder;
use Ace\Schedule\iValue;

use Ace\Schedule\Item\Minute;
use Ace\Schedule\Item\Hour;
use Ace\Schedule\Item\Day;
use Ace\Schedule\Item\Month;
use Ace\Schedule\Item\WeekDay;


/**
* builds parts of a Schedule 
*/
class Builder implements IBuilder
{
	/**
	* @var array
	*/
	protected $matchers = array();

	/**
	* @param iValue $value
	*/
	public function buildMinute(iValue $value){
		$this->matchers['minute'] = new Minute($value);
	}

	/**
	* @param iValue $value
	* @return Hour
	*/
	public function buildHour(iValue $value){
		$this->matchers['hour'] = new Hour($value);
	}

	/**
	* @param iValue $value
	* @return Day
	*/
	public function buildDay(iValue $value){
		$this->matchers['day'] = new Day($value);
	}

	/**
	* @param iValue $value
	* @return Month
	*/
	public function buildMonth(iValue $value){
		$this->matchers['month'] = new Month($value);
	}

	/**
	* @param iValue $value
	* @return WeekDay
	*/
	public function buildWeekDay(iValue $value){
		$this->matchers['week_day'] = new WeekDay($value);
	}

	public function getMatchers()
	{
		return $this->matchers;
	}
}

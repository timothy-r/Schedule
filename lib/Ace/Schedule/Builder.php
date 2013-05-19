<?php
namespace Ace\Schedule;
use Ace\Schedule\IBuilder;
use Ace\Schedule\IValue;

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
	* @param IValue $value
	*/
	public function buildMinute(IValue $value){
		$this->matchers['minute'] = new Minute($value);
	}

	/**
	* @param IValue $value
	* @return Hour
	*/
	public function buildHour(IValue $value){
		$this->matchers['hour'] = new Hour($value);
	}

	/**
	* @param IValue $value
	* @return Day
	*/
	public function buildDay(IValue $value){
		$this->matchers['day'] = new Day($value);
	}

	/**
	* @param IValue $value
	* @return Month
	*/
	public function buildMonth(IValue $value){
		$this->matchers['month'] = new Month($value);
	}

	/**
	* @param IValue $value
	* @return WeekDay
	*/
	public function buildWeekDay(IValue $value){
		$this->matchers['week_day'] = new WeekDay($value);
	}

	public function getMatchers()
	{
		return $this->matchers;
	}
}

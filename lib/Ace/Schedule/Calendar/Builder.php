<?php
namespace Ace\Schedule\Calendar;
use Ace\Schedule\iBuilder;
use Ace\Schedule\Exception;

use Ace\Schedule\Item\Minute;
use Ace\Schedule\Item\Hour;
use Ace\Schedule\Item\Day;
use Ace\Schedule\Item\Month;
use Ace\Schedule\Item\WeekDay;

use Ace\Schedule\Value\Literal;

/**
* builds parts of a Schedule based on a date format
* @todo - more validation of tokens
*/
class Builder implements iBuilder
{
	/**
	* @var array
	*/
	protected $matchers = array();

	/**
	* @param string $token
	*/
	public function buildMinute($token){
		if (!is_numeric($token)){
			throw new Exception("$token is not numeric");
		}
		$token = intval($token) % 60;
		$this->matchers['minute'] = new Minute(new Literal($token));
	}

	/**
	* @param string $token
	*/
	public function buildHour($token){
		$this->matchers['hour'] = new Hour(new Literal($token));
	}

	/**
	* @param string $token
	*/
	public function buildDay($token){
		$this->matchers['day'] = new Day(new Literal($token));
	}

	/**
	* @param string $token
	*/
	public function buildMonth($token){
		$this->matchers['month'] = new Month(new Literal($token));
	}

	/**
	* @param string $token
	*/
	public function buildWeekDay($token){
		$this->matchers['week_day'] = new WeekDay(new Literal($token));
	}

	public function getMatchers()
	{
		return $this->matchers;
	}
}

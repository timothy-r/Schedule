<?php
namespace Ace\Schedule\Cron;
use Ace\Schedule\iBuilder;

use Ace\Schedule\Item\Minute;
use Ace\Schedule\Item\Hour;
use Ace\Schedule\Item\Day;
use Ace\Schedule\Item\Month;
use Ace\Schedule\Item\WeekDay;

use Ace\Schedule\Value\AList;
use Ace\Schedule\Value\Literal;
use Ace\Schedule\Value\Interval;
use Ace\Schedule\Value\Range;
use Ace\Schedule\Value\WildCard;

/**
* builds parts of a Schedule based on a Cron tab format
* @todo - more validation of tokens
*/
class Builder implements iBuilder
{
	/**
	* @param string $token
	* @return Minute
	*/
	public function buildMinute($token){
		return new Minute($this->getValue($token, '0','59'));
	}

	/**
	* @param string $token
	* @return Hour
	*/
	public function buildHour($token){
		return new Hour($this->getValue($token, '0', '24'));
	}

	/**
	* @param string $token
	* @return Day
	*/
	public function buildDay($token){
		return new Day($this->getValue($token, '1', '31'));
	}

	/**
	* @param string $token
	* @return Month
	*/
	public function buildMonth($token){
		return new Month($this->getValue($token, '1', '12'));
	}

	/**
	* @param string $token
	* @return WeekDay
	*/
	public function buildWeekDay($token){
		return new WeekDay($this->getValue($token, '0', '6'));
	}

	/**
	* @param string $token the raw string from the schedule
	* @return iValue
	*/
	protected function getValue($token, $low, $high) {
		// a wild card *
		if (('*' == $token) || ('?' == $token)){
			return new WildCard;
		}

		// token is a single value - allow for strings for week_day
		if (preg_match('/^(\d+|\w+)$/', $token)){
			return new Literal($token);
		}

		// a set of tokens 1,2,3
		if (preg_match('/,/', $token)){
			return new AList(explode(',', $token));
		}

		// a range of values 1-3
		if (preg_match('/\-/', $token)){
			$values = explode('-', $value);
			return new Range($values[0], $values[1]);
		}

		// an interval set 1-5/1
		if (preg_match('#/#', $token)){
			$values = explode('/', $value);
			$range = $this->getValue($values[0], $low, $high);
			return new Interval($range, $values[1]);
		}

		throw new \Ace\Schedule\Exception("'$token' is not a valid cron schedule field value");
	}
}

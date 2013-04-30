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

class Builder implements iBuilder
{
	/**
	* @param string $value
	* @return Minute
	*/
	public function buildMinute($value){
		return new Minute($this->getValue($value, '0','59'));
	}

	public function buildHour($value){
		return new Hour($this->getValue($value, '0', '24'));
	}

	public function buildDay($value){
		return new Day($this->getValue($value, '1', '31'));
	}

	public function buildMonth($value){
		return new Month($this->getValue($value, '1', '12'));
	}

	public function buildWeekDay($value){
		return new WeekDay($this->getValue($value, '0', '6'));
	}

	/**
	* @param string $value the raw string from the schedule
	* @return iValue
	*/
	protected function getValue($value, $low, $high) {
		// a wild card *
		if (('*' == $value) || ('?' == $value)){
			return new WildCard;
		}

		// value is a single value - allow for strings for week_day
		if (preg_match('/^(\d+|\w+)$/', $value)){
			return new Literal($value);
		}

		// a set of values 1,2,3
		if (preg_match('/,/', $value)){
			return new AList(explode(',', $value));
		}

		// a range of values 1-3
		if (preg_match('/\-/', $value)){
			$values = explode('-', $value);
			return new Range($values[0], $values[1]);
		}

		// an interval set 1-5/1
		if (preg_match('#/#', $value)){
			$values = explode('/', $value);
			$range = $this->getValue($values[0], $low, $high);
			return new Interval($range, $values[1]);
		}

		throw new \Ace\Schedule\Exception("'$value' is not a valid cron schedule field value");
	}
}

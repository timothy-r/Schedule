<?php
namespace Ace\Schedule;

use Ace\Schedule\Value\AList;
use Ace\Schedule\Value\Literal;
use Ace\Schedule\Value\Interval;
use Ace\Schedule\Value\Range;

use Ace\Schedule\Item\Minute;
use Ace\Schedule\Item\Hour;
use Ace\Schedule\Item\Day;
use Ace\Schedule\Item\Month;
use Ace\Schedule\Item\WeekDay;

/**
* contains a single schedule entry
* @todo convert to take a set of iMatcher instances
*/
class Entry {
	/**
	* the formatted schedule string
	*/
	protected $schedule;

	protected $matchers;

	public function __construct($schedule){
		$this->schedule = $schedule;
	}

	/**
	* for a schedule to match all its items must match
	* @return boolean
	*/
	public function matches(\DateTime $date_time){
		$matchers = $this->getMatchers();
		foreach($matchers as $matcher){
			if (!$matcher->matches($date_time)){
				return false;
			}
		}
		return true;
	}

	public function isValid() {
		try {
			$matchers = $this->getMatchers();
			return true;
		} catch (\Ace\Schedule\Exception $e){
			return false;
		}
	}
	
	/**
	* @deprecated
	*/
	protected function getMatchers() {
		if (empty($this->matchers)){
			$this->matchers = array();
			$items = preg_split('/[\s]+/', $this->schedule);
			// parse each item to create a *Value instance
			$this->matchers['min']= new Minute($this->getValue($items[0], '0', '59'));
			$this->matchers['hour']= new Hour($this->getValue($items[1], '0', '24'));
			$this->matchers['day']= new Day($this->getValue($items[2], '1', '31'));
			$this->matchers['month']= new Month($this->getValue($items[3], '1', '12'));
			$this->matchers['week_day']= new WeekDay($this->getValue($items[4], '0', '6'));
		}
		return $this->matchers;
	}

	/**
	* @deprecated
	* @param string $value the raw string from the schedule
	* @return iValue
	*/
	protected function getValue($value, $low, $high) {
		// a wild card *
		if (('*' == $value) || ('?' == $value)){
			return new Range($low, $high);
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

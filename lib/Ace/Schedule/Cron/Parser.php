<?php
namespace Ace\Schedule\Cron;
use Ace\Schedule\iParser;
use Ace\Schedule\Exception;

use Ace\Schedule\Value\WildCard;
use Ace\Schedule\Value\Literal;
use Ace\Schedule\Value\Interval;
use Ace\Schedule\Value\AList;
use Ace\Schedule\Value\Range;

/**
* parses a cron formatted string into its parts
*/
class Parser implements iParser
{
    protected $valid = false;

    protected $minute;

    protected $hour;

    protected $day;

    protected $month;

    protected $week_day;

    /**
    * @param string $schedule
    * @return boolean
    */
    public function parse($schedule)
    {
        $this->valid = false;
		$items = preg_split('/[\s]+/', $schedule);
		if (count($items) != 5){
            return false;	
		}
        try {
            $this->minute = $this->getValue($items[0]);
            $this->hour = $this->getValue($items[1]);
            $this->day = $this->getValue($items[2]);
            $this->month = $this->getValue($items[3]);
            $this->week_day = $this->getValue($items[4]);
            $this->valid = true;
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
    * @return iValue
    */
    public function getMinute()
    {
        if (!$this->valid){
            throw new Exception("getMinute() called for invalid schedule");
        }
    }

    /**
    * @return iValue
    */
    public function getHour()
    {
        if (!$this->valid){
            throw new Exception("getHour() called for invalid schedule");
        }
    }

    /**
    * @return iValue
    */
    public function getDay()
    {
        if (!$this->valid){
            throw new Exception("getDay() called for invalid schedule");
        }
    }

    /**
    * @return iValue
    */
    public function getMonth()
    {
        if (!$this->valid){
            throw new Exception("getMonth() called for invalid schedule");
        }
    }

    /**
    * @return iValue
    */
    public function getWeekDay()
    {
        if (!$this->valid){
            throw new Exception("getWeekDay() called for invalid schedule");
        }
    }

    /**
    * @return iValue
    */
    public function getYear()
    {
    }

	/**
	* @param string $token the raw string from the schedule
	* @return iValue
	*/
	protected function getValue($token) {
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
			$values = explode('-', $token);
			return new Range($values[0], $values[1]);
		}

		// an interval set 1-5/1
		if (preg_match('#/#', $token)){
			$values = explode('/', $token);
			$range = $this->getValue($values[0]);
			return new Interval($range, $values[1]);
		}

		throw new \Ace\Schedule\Exception("'$token' is not a valid cron schedule field value");
	}

}

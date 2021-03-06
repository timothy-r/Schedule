<?php namespace Ace\Schedule\Cron;

use Ace\Schedule\ParserInterface;
use Ace\Schedule\Exception;

use Ace\Schedule\Value\WildCard;
use Ace\Schedule\Value\Literal;
use Ace\Schedule\Value\Interval;
use Ace\Schedule\Value\AList;
use Ace\Schedule\Value\Range;

/**
* parses a cron formatted string into its parts
*/
class Parser implements ParserInterface
{
    private $valid = false;

    private $minute;

    private $hour;

    private $day;

    private $month;

    private $week_day;

    private $year;

    /**
    * @param string $schedule
    * @return boolean
    */
    public function parse($schedule)
    {
        $this->valid = false;
		$items = preg_split('/[\s]+/', $schedule);
		if (count($items) != 5){
            throw new Exception(sprintf('"%s" is invalid', $schedule));
		}
        $this->minute = $this->getValue($items[0]);
        $this->hour = $this->getValue($items[1]);
        $this->day = $this->getValue($items[2]);
        $this->month = $this->getValue($items[3]);
        $this->week_day = $this->getValue($items[4]);
        $this->year = new WildCard;
        $this->valid = true;
        return true;
    }

    /**
     * @return IValue
     */
    public function getMinute()
    {
            if (!$this->valid){
                    throw new Exception("getMinute() called for invalid schedule");
            }
            return $this->minute;
    }

    /**
     * @return IValue
     */
    public function getHour()
    {
            if (!$this->valid){
                    throw new Exception("getHour() called for invalid schedule");
            }
            return $this->hour;
    }

    /**
    * @return IValue
    */
    public function getDay()
    {
        if (!$this->valid){
            throw new Exception("getDay() called for invalid schedule");
        }
        return $this->day;
    }

    /**
    * @return IValue
    */
    public function getMonth()
    {
        if (!$this->valid){
            throw new Exception("getMonth() called for invalid schedule");
        }
        return $this->month;
    }

    /**
    * @return IValue
    */
    public function getWeekDay()
    {
        if (!$this->valid){
            throw new Exception("getWeekDay() called for invalid schedule");
        }
        return $this->week_day;
    }

    /**
    * @return IValue
    */
    public function getYear()
    {
        if (!$this->valid){
            throw new Exception("getYear() called for invalid schedule");
        }
        return $this->year;
    }

	/**
	* @param string $token the raw string from the schedule
	* @return IValue
	*/
	private function getValue($token) {
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

		throw new Exception("'$token' is not a valid cron schedule field value");
	}

}

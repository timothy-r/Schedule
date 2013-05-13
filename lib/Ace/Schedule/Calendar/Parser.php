<?php
namespace Ace\Schedule\Calendar;
use Ace\Schedule\iParser;
use Ace\Schedule\Exception;

use Ace\Schedule\Value\Literal;
use Ace\Schedule\Value\WildCard;

/**
* parses a calendar formatted string into its parts
*/
class Parser implements iParser
{
    protected $valid = false;

    protected $minute;

    protected $hour;

    protected $day;

    protected $month;

    protected $week_day;

    protected $year;

    /**
    * @param string $schedule
    * @return boolean
    */
    public function parse($schedule)
    {
        $this->valid = false;
        $values = date_parse($schedule);
        if ($values['error_count'] > 0){
            return false;
        }

        if ($values['minute']){
            $this->minute = new Literal($values['minute']);
        } else {
            $this->minute = new WildCard;
        }

        if ($values['hour']){
            $this->hour = new Literal($values['hour']);
        } else {
            $this->hour = new WildCard;
        }

        if ($values['day']){
            $this->day = new Literal($values['day']);
        } else {
            $this->day = new WildCard;
        }

        if ($values['month']){
            $this->month = new Literal($values['month']);
        } else {
            $this->month = new WildCard;
        }

        if ($values['year']){
            $this->year = new Literal($values['year']);
        } else {
            $this->year = new WildCard;
        }

        #$this->week_day = $this->getValue($items[4]);
        $this->valid = true;
        return true;
    }

    /**
     * @return iValue
     */
    public function getMinute()
    {
            if (!$this->valid){
                    throw new Exception("getMinute() called for invalid schedule");
            }
            return $this->minute;
    }

    /**
     * @return iValue
     */
    public function getHour()
    {
         if (!$this->valid){
            throw new Exception("getHour() called for invalid schedule");
         }
         return $this->hour;
    }

    /**
     * @return iValue
     */
    public function getDay()
    {
            if (!$this->valid){
                    throw new Exception("getDay() called for invalid schedule");
            }
            return $this->day;
    }

    /**
     * @return iValue
     */
    public function getMonth()
    {
            if (!$this->valid){
                    throw new Exception("getMonth() called for invalid schedule");
            }
            return $this->month;
    }

    /**
     * @return iValue
     */
    public function getWeekDay()
    {
            if (!$this->valid){
                    throw new Exception("getWeekDay() called for invalid schedule");
            }
            return $this->week_day;
    }

    /**
     * @return iValue
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

            throw new Exception("'$token' is not a valid calendar schedule field value");
    }

}

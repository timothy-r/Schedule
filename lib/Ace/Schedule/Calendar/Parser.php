<?php namespace Ace\Schedule\Calendar;

use Ace\Schedule\ParserInterface;
use Ace\Schedule\Exception;

use Ace\Schedule\Value\Literal;
use Ace\Schedule\Value\WildCard;

/**
* parses a calendar formatted string into its parts
*/
class Parser implements ParserInterface
{
    private $valid = false;

    private $minute;

    private $hour;

    private $day;

    private $month;

    private $year;

    /**
    * @param string $schedule
    * @return boolean
    */
    public function parse($schedule)
    {
        $this->valid = false;
        $values = date_parse($schedule);
        if ($values['error_count'] > 0){
            throw new Exception(sprintf('"$schedule" is invalid', $schedule));
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
            return null;
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
}

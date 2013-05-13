<?php
namespace Ace\Schedule;

/**
* interface to extracting schedule items from a schedule string
*/
interface iParser
{
    /**
    * @param string $schedule
    * @return boolean
    */
    public function parse($schedule);

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return iValue
    */
    public function getMinute();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return iValue
    */
    public function getHour();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return iValue
    */
    public function getDay();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return iValue
    */
    public function getMonth();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return iValue
    */
    public function getWeekDay();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return iValue
    */
    public function getYear();
}


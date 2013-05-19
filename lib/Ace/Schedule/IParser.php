<?php
namespace Ace\Schedule;

/**
* interface to extracting schedule items from a schedule string
*/
interface IParser
{
    /**
    * @param string $schedule
    * @return boolean
    */
    public function parse($schedule);

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return IValue
    */
    public function getMinute();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return IValue
    */
    public function getHour();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return IValue
    */
    public function getDay();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return IValue
    */
    public function getMonth();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return IValue
    */
    public function getWeekDay();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return IValue
    */
    public function getYear();
}


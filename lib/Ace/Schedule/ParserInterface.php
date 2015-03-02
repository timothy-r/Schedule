<?php namespace Ace\Schedule;

/**
* interface to extracting schedule items from a schedule string
*/
interface ParserInterface
{
    /**
    * @param string $schedule
    * @return boolean
    */
    public function parse($schedule);

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return ValueInterface
    */
    public function getMinute();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return ValueInterface
    */
    public function getHour();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return ValueInterface
    */
    public function getDay();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return ValueInterface
    */
    public function getMonth();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return ValueInterface
    */
    public function getWeekDay();

    /**
    * @throws Ace\Schedule\Exception if parse failed
    * @return ValueInterface
    */
    public function getYear();
}


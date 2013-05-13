<?php
namespace Ace\Schedule;

interface iParser
{
    /**
    * @return iValue
    */
    public function getMinute();

    /**
    * @return iValue
    */
    public function getHour();

    /**
    * @return iValue
    */
    public function getDay();

    /**
    * @return iValue
    */
    public function getMonth();

    /**
    * @return iValue
    */
    public function getWeekDay();

    /**
    * @return iValue
    */
    public function getYear();
}


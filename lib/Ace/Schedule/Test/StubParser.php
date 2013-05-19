<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\IParser;

/**
* @codeCoverageIgnore
*/
class StubParser implements IParser
{
    public function parse($schedule){}

    public function getMinute(){}

    public function getHour(){}

    public function getDay(){}

    public function getMonth(){}

    public function getWeekDay(){}

    public function getYear(){}
}

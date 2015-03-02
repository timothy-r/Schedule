<?php namespace Ace\Schedule;

use Ace\Schedule\ParserFactoryInterface;
use Ace\Schedule\Cron\Parser as CronParser;
use Ace\Schedule\Calendar\Parser as CalendarParser;
use Ace\Schedule\Exception as ScheduleException;

class ParserFactory implements ParserFactoryInterface
{
    /**
     * @param $type string
     * @return CalendarParser|CronParser
     * @throws Ace\Schedule\Exception
     */
    public function create($type)
    {
        switch ($type){
            case 'cron':
                return new CronParser;
            case 'calendar':
                return new CalendarParser;
        }
        throw new ScheduleException("Unknown schedule type '$type'");
    }
}
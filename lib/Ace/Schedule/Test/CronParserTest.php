<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Cron\Parser;
use Ace\Schedule\IValue;

class CronParserTest extends \PHPUnit_Framework_TestCase
{
    public function getValidSchedules()
    {
        return array(
            array('* * * * *', 'Ace\Schedule\Value\WildCard'),
            array('1 2 3 4 5', 'Ace\Schedule\Value\Literal'),
            array('1,2,3 1,2,3 1,2,3 1,2,4 5,6', 'Ace\Schedule\Value\AList'),
            array('1-2 2-3 1-5 1-4 2-6', 'Ace\Schedule\Value\Range'),
            array('*/2 */3 */5 */4 */1', 'Ace\Schedule\Value\Interval'),
        );
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetYearForValidSchedule($schedule, $type)
    {
        $this->parser = new Parser;
        $result = $this->parser->parse($schedule);
        $year = $this->parser->getYear();
        $this->assertInstanceOf('Ace\Schedule\IValue', $year);
        $this->assertInstanceOf('Ace\Schedule\Value\WildCard', $year);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetWeekDayForValidSchedule($schedule, $type)
    {
        $this->parser = new Parser;
        $result = $this->parser->parse($schedule);
        $week_day = $this->parser->getWeekDay();
        $this->assertInstanceOf('Ace\Schedule\IValue', $week_day);
        $this->assertInstanceOf($type, $week_day);
    }
}

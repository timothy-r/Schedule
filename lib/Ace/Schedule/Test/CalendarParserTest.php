<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Calendar\Parser;
use Ace\Schedule\ValueInterface;

class CalendarParserTest extends \PHPUnit_Framework_TestCase
{
    public function getValidSchedules()
    {
        return array(
            array('26th June 2013 10am'),
            array('26th June 2013 10:10am'),
            array('10:10am'),
            array('26th June 2013'),
        );
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testParseValidScheduleReturnsTrue($schedule)
    {
        $this->parser = new Parser;
        $result = $this->parser->parse($schedule);
        $this->assertTrue($result);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetWeekDayForValidScheduleReturnsNull($schedule)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $week_day = $parser->getWeekDay();
        $this->assertNull($week_day);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetYearForValidSchedule($schedule)
    {
        $this->parser = new Parser;
        $result = $this->parser->parse($schedule);
        $year = $this->parser->getYear();
        $this->assertInstanceOf('Ace\Schedule\IValue', $year);
    }
}

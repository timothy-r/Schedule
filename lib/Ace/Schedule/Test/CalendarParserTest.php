<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Calendar\Parser;
use Ace\Schedule\IValue;

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
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $this->assertTrue($result);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetMinuteForValidSchedule($schedule)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $minute = $parser->getMinute();
        $this->assertInstanceOf('Ace\Schedule\IValue', $minute);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetHourForValidSchedule($schedule)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $hour = $parser->getHour();
        $this->assertInstanceOf('Ace\Schedule\IValue', $hour);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetDayForValidSchedule($schedule)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $day = $parser->getDay();
        $this->assertInstanceOf('Ace\Schedule\IValue', $day);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetMonthForValidSchedule($schedule)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $month = $parser->getMonth();
        $this->assertInstanceOf('Ace\Schedule\IValue', $month);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetWeekDayForValidSchedule($schedule)
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
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $year = $parser->getYear();
        $this->assertInstanceOf('Ace\Schedule\IValue', $year);
    }

    public function getInvalidSchedules()
    {
        return array(
            array(''),
            array('34w12*')
        );
    }

    /**
    * @dataProvider getInvalidSchedules
    */
    public function testParseInvalidScheduleReturnsFalse($schedule)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $this->assertFalse($result);
    }

    /**
    * @dataProvider getInvalidSchedules
    */
    public function testGetMinuteWithInvalidScheduleThrowsException($schedule)
    {
        $parser = new Parser;
        $parser->parse($schedule);
        $this->setExpectedException('Ace\Schedule\Exception');
        $parser->getMinute();
    }

    /**
    * @dataProvider getInvalidSchedules
    */
    public function testGetHourWithInvalidScheduleThrowsException($schedule)
    {
        $parser = new Parser;
        $parser->parse($schedule);
        $this->setExpectedException('Ace\Schedule\Exception');
        $parser->getHour();
    }

    /**
    * @dataProvider getInvalidSchedules
    */
    public function testGetDayWithInvalidScheduleThrowsException($schedule)
    {
        $parser = new Parser;
        $parser->parse($schedule);
        $this->setExpectedException('Ace\Schedule\Exception');
        $parser->getDay();
    }

    /**
    * @dataProvider getInvalidSchedules
    */
    public function testGetMonthWithInvalidScheduleThrowsException($schedule)
    {
        $parser = new Parser;
        $parser->parse($schedule);
        $this->setExpectedException('Ace\Schedule\Exception');
        $parser->getMonth();
    }

    /**
    * @dataProvider getInvalidSchedules
    */
    public function testGetWeekDayWithInvalidScheduleThrowsException($schedule)
    {
        $parser = new Parser;
        $parser->parse($schedule);
        $this->setExpectedException('Ace\Schedule\Exception');
        $parser->getWeekDay();
    }

    /**
    * @dataProvider getInvalidSchedules
    */
    public function testGetYearWithInvalidScheduleThrowsException($schedule)
    {
        $parser = new Parser;
        $parser->parse($schedule);
        $this->setExpectedException('Ace\Schedule\Exception');
        $parser->getYear();
    }
}

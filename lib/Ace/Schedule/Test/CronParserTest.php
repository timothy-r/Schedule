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
    public function testParseValidScheduleReturnsTrue($schedule)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $this->assertTrue($result);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetMinuteForValidSchedule($schedule, $type)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $minute = $parser->getMinute();
        $this->assertInstanceOf('Ace\Schedule\IValue', $minute);
        $this->assertInstanceOf($type, $minute);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetHourForValidSchedule($schedule, $type)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $hour = $parser->getHour();
        $this->assertInstanceOf('Ace\Schedule\IValue', $hour);
        $this->assertInstanceOf($type, $hour);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetDayForValidSchedule($schedule, $type)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $day = $parser->getDay();
        $this->assertInstanceOf('Ace\Schedule\IValue', $day);
        $this->assertInstanceOf($type, $day);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetMonthForValidSchedule($schedule, $type)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $month = $parser->getMonth();
        $this->assertInstanceOf('Ace\Schedule\IValue', $month);
        $this->assertInstanceOf($type, $month);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetWeekDayForValidSchedule($schedule, $type)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $week_day = $parser->getWeekDay();
        $this->assertInstanceOf('Ace\Schedule\IValue', $week_day);
        $this->assertInstanceOf($type, $week_day);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetYearForValidSchedule($schedule, $type)
    {
        $parser = new Parser;
        $result = $parser->parse($schedule);
        $year = $parser->getYear();
        $this->assertInstanceOf('Ace\Schedule\IValue', $year);
        $this->assertInstanceOf('Ace\Schedule\Value\WildCard', $year);
    }

    public function getInvalidSchedules()
    {
        return array(
            array('*$'),
            array('* $ ^ & £')
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

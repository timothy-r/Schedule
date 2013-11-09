<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\IValue;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    protected $parser;

    public function getValidSchedules()
    {
        return array(
            array('Ace\Schedule\Cron\Parser','* * * * *', 'Ace\Schedule\Value\WildCard'),
            array('Ace\Schedule\Cron\Parser','1 2 3 4 5', 'Ace\Schedule\Value\Literal'),
            array('Ace\Schedule\Cron\Parser','1,2,3 1,2,3 1,2,3 1,2,4 5,6', 'Ace\Schedule\Value\AList'),
            array('Ace\Schedule\Cron\Parser','1-2 2-3 1-5 1-4 2-6', 'Ace\Schedule\Value\Range'),
            array('Ace\Schedule\Cron\Parser','*/2 */3 */5 */4 */1', 'Ace\Schedule\Value\Interval'),
            array('Ace\Schedule\Calendar\Parser', '26th June 2013 10:10am', 'Ace\Schedule\Value\Literal'),
        );
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testParseValidScheduleReturnsTrue($class, $schedule, $type)
    {
        $this->parser = new $class;
        $result = $this->parser->parse($schedule);
        $this->assertTrue($result);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetMinuteForValidSchedule($class, $schedule, $type)
    {
        $this->parser = new $class;
        $result = $this->parser->parse($schedule);
        $minute = $this->parser->getMinute();
        $this->assertInstanceOf('Ace\Schedule\IValue', $minute);
        $this->assertInstanceOf($type, $minute);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetHourForValidSchedule($class, $schedule, $type)
    {
        $this->parser = new $class;
        $result = $this->parser->parse($schedule);
        $hour = $this->parser->getHour();
        $this->assertInstanceOf('Ace\Schedule\IValue', $hour);
        $this->assertInstanceOf($type, $hour);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetDayForValidSchedule($class, $schedule, $type)
    {
        $this->parser = new $class;
        $result = $this->parser->parse($schedule);
        $day = $this->parser->getDay();
        $this->assertInstanceOf('Ace\Schedule\IValue', $day);
        $this->assertInstanceOf($type, $day);
    }

    /**
    * @dataProvider getValidSchedules
    */
    public function testGetMonthForValidSchedule($class, $schedule, $type)
    {
        $this->parser = new $class;
        $result = $this->parser->parse($schedule);
        $month = $this->parser->getMonth();
        $this->assertInstanceOf('Ace\Schedule\IValue', $month);
        $this->assertInstanceOf($type, $month);
    }


    public function getInvalidSchedules()
    {
        return array(
            array('Ace\Schedule\Cron\Parser', '*$'),
            array('Ace\Schedule\Cron\Parser', '* $ ^ & £'),
            array('Ace\Schedule\Calendar\Parser', '£'),
            array('Ace\Schedule\Calendar\Parser', '* * * * *'),
        );
    }

    /**
    * @dataProvider getInvalidSchedules
    * @expectedException Ace\Schedule\Exception
    */
    public function testParseInvalidScheduleReturnsFalse($class, $schedule)
    {
        $this->parser = new $class;
        $result = $this->parser->parse($schedule);
        $this->assertFalse($result);
    }

    /**
    * @dataProvider getInvalidSchedules
    * @expectedException Ace\Schedule\Exception
    */
    public function testGetMinuteWithInvalidScheduleThrowsException($class, $schedule)
    {
        $this->parser = new $class;
        $this->parser->parse($schedule);
        $this->parser->getMinute();
    }

    /**
    * @dataProvider getInvalidSchedules
    * @expectedException Ace\Schedule\Exception
    */
    public function testGetHourWithInvalidScheduleThrowsException($class, $schedule)
    {
        $this->parser = new $class;
        $this->parser->parse($schedule);
        $this->parser->getHour();
    }

    /**
    * @dataProvider getInvalidSchedules
    * @expectedException Ace\Schedule\Exception
    */
    public function testGetDayWithInvalidScheduleThrowsException($class, $schedule)
    {
        $this->parser = new $class;
        $this->parser->parse($schedule);
        $this->parser->getDay();
    }

    /**
    * @dataProvider getInvalidSchedules
    * @expectedException Ace\Schedule\Exception
    */
    public function testGetMonthWithInvalidScheduleThrowsException($class, $schedule)
    {
        $this->parser = new $class;
        $this->parser->parse($schedule);
        $this->parser->getMonth();
    }

    /**
    * @dataProvider getInvalidSchedules
    * @expectedException Ace\Schedule\Exception
    */
    public function testGetWeekDayWithInvalidScheduleThrowsException($class, $schedule)
    {
        $this->parser = new $class;
        $this->parser->parse($schedule);
        $this->parser->getWeekDay();
    }

    /**
    * @dataProvider getInvalidSchedules
    * @expectedException Ace\Schedule\Exception
    */
    public function testGetYearWithInvalidScheduleThrowsException($class, $schedule)
    {
        $this->parser = new $class;
        $this->parser->parse($schedule);
        $this->parser->getYear();
    }
}

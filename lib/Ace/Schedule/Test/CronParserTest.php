<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Cron\Parser;

class CronParserTest extends \PHPUnit_Framework_TestCase
{
    public function getValidSchedules()
    {
        return array(
            array('* 2 10 * *')
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

}

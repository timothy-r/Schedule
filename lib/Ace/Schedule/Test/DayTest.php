<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Item\Day;
use Ace\Schedule\Value\Literal;

/**
* @group unit
* @group schedule
*/
class DayTest extends ScheduleTest
{
	
	public function testDayMatchesValue() {
		for ($day = 1; $day <= 31; $day++) {
			$matcher = new Day(new Literal($day));
			$date_string = "2012-05-" . str_pad("$day", 2, '0', STR_PAD_LEFT);
			$date_time = new \DateTime($date_string);
			$result = $matcher->matches($date_time);
			$this->assertTrue($result, "Expected day '$day' to match '$date_string'");
		}
	}

	public function testDayDoesNotMatchValue() {
		$matcher = new Day(new Literal(5));
		$date_string = "2012-07-01";
		$date_time = new \DateTime($date_string);
		$result = $matcher->matches($date_time);
		$this->assertFalse($result, "Did not expected day '6' to match '$date_string'");
	}

    /**
    * @expectedException Ace\Schedule\Exception
    */
    public function testDayValidatesLowestValue()
    {
        $value = $this->helper->createMock(
            'Ace\Schedule\Test\StubValue', 
            array('lessThan' => false, 'greaterThan' => true)
        );
        $minute = new Day($value);
    }

    /**
    * @expectedException Ace\Schedule\Exception
    */
    public function testDayValidatesHighestValue()
    {
        $value = $this->helper->createMock(
            'Ace\Schedule\Test\StubValue', 
            array('lessThan' => true, 'greaterThan' => false)
        );
        $minute = new Day($value);
    }
}

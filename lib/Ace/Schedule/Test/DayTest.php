<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Item\Day;
use Ace\Schedule\Value\Literal;

require_once(dirname(__FILE__)."/../iMatcher.php");
require_once(dirname(__FILE__)."/../Item/Day.php");

/**
* @group unit
* @group schedule
*/
class DayTestCase extends \PHPUnit_Framework_TestCase {
	
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

    public function testDayValidatesLowestValue()
    {
        $value = $this->getMock('Ace\Schedule\Test\Stub_Value', array('lessThan','greaterThan'));
        $value->expects($this->any())
            ->method('lessThan')
            ->will($this->returnValue(false));
        $value->expects($this->any())
            ->method('greaterThan')
            ->will($this->returnValue(true));
        $this->setExpectedException('Ace\Schedule\Exception');
        $minute = new Day($value);
    }

    public function testDayValidatesHighestValue()
    {
        $value = $this->getMock('Ace\Schedule\Test\Stub_Value', array('lessThan','greaterThan'));
        $value->expects($this->any())
            ->method('lessThan')
            ->will($this->returnValue(true));
        $value->expects($this->any())
            ->method('greaterThan')
            ->will($this->returnValue(false));
        $this->setExpectedException('Ace\Schedule\Exception');
        $minute = new Day($value);
    }
}

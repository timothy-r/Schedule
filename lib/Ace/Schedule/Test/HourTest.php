<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Item\Hour;
use Ace\Schedule\Value\Literal;

/**
* @group unit
* @group schedule
*/
class HourTestCase extends \PHPUnit_Framework_TestCase {
	public function testHourMatchesValue() {
		for ($hour = 0; $hour < 24; $hour++) {
			$matcher = new Hour(new Literal($hour));
			$date_string = "2012-05-20 " . str_pad("$hour", 2, '0', STR_PAD_LEFT) . ":24:05";
			$date_time = new \DateTime($date_string);
			$result = $matcher->matches($date_time);
			$this->assertTrue($result, "Expected '$hour' to match '$date_string'");
		}
	}

	public function testHourDoesNotMatchValue() {
		$matcher = new Hour(new Literal(7));
		$date_string = "2012-05-20 01:24:05";
		$date_time = new \DateTime($date_string);
		$result = $matcher->matches($date_time);
		$this->assertFalse($result, "Did not expected '7' to match '$date_string'");
	}

    public function testHourValidatesLowestValue()
    {
        $value = $this->getMock('Ace\Schedule\Test\Stub_Value', array('lessThan','greaterThan'));
        $value->expects($this->any())
            ->method('lessThan')
            ->will($this->returnValue(false));
        $value->expects($this->any())
            ->method('greaterThan')
            ->will($this->returnValue(true));
        $this->setExpectedException('Ace\Schedule\Exception');
        $minute = new Hour($value);
    }

    public function testHourValidatesHighestValue()
    {
        $value = $this->getMock('Ace\Schedule\Test\Stub_Value', array('lessThan','greaterThan'));
        $value->expects($this->any())
            ->method('lessThan')
            ->will($this->returnValue(true));
        $value->expects($this->any())
            ->method('greaterThan')
            ->will($this->returnValue(false));
        $this->setExpectedException('Ace\Schedule\Exception');
        $minute = new Hour($value);
    }
}

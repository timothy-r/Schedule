<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Item\Month;
use Ace\Schedule\Value\Literal;

require_once(dirname(__FILE__)."/../iMatcher.php");
require_once(dirname(__FILE__)."/../Item/Month.php");

/**
* @group unit
* @group schedule
*/
class MonthTestCase extends \PHPUnit_Framework_TestCase {
	
	public function testMonthMatchesValue() {
		for ($month = 1; $month < 12; $month++) {
			$matcher = new Month(new Literal($month));
			//add month as seconds to 0 and set as timestamp for DateTime
			$actual_month = $month - 1;
			$date_string = "2012-$month-18";
			$date_time = new \DateTime($date_string);
			$result = $matcher->matches($date_time);
			$this->assertTrue($result, "Expected '$month' to match '$date_string'");
		}
	}

	public function testMonthDoesNotMatchValue() {
		$month = 1;
		$matcher = new Month(new Literal(6));
		// add month as seconds to 0 and set as timestamp for DateTime
		$date_string = "2012-$month-18";
		$date_time = new \DateTime($date_string);
		$result = $matcher->matches($date_time);
		$this->assertFalse($result, "Did not expected '$month+1' to match '$date_string'");
	}

    public function testMonthValidatesMinValue()
    {
        $value = $this->getMock('Ace\Schedule\Test\Stub_Value', array('min','max'));
        $value->expects($this->any())
            ->method('min')
            ->will($this->returnValue(0));
        $value->expects($this->any())
            ->method('max')
            ->will($this->returnValue(5));
        $this->setExpectedException('Ace\Schedule\Exception');
        $minute = new Month($value);
    }

    public function testMonthValidatesMaxValue()
    {
        $value = $this->getMock('Ace\Schedule\Test\Stub_Value', array('min','max'));
        $value->expects($this->any())
            ->method('min')
            ->will($this->returnValue(4));
        $value->expects($this->any())
            ->method('max')
            ->will($this->returnValue(600));
        $this->setExpectedException('Ace\Schedule\Exception');
        $minute = new Month($value);
    }
}

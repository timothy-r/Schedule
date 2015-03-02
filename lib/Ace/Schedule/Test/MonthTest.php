<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Item\Month;
use Ace\Schedule\Value\Literal;
use Ace\Schedule\Test\MockTrait;
use PHPUnit_Framework_TestCase;

/**
* @group unit
* @group schedule
*/
class MonthTestCase extends PHPUnit_Framework_TestCase
{
	use MockTrait;

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

    /**
    * @expectedException Ace\Schedule\Exception
    */
    public function testMonthValidatesLowestValue()
    {
        $this->givenAValueThatIsTooLow();
        $month = new Month($this->value);
    }

    /**
    * @expectedException Ace\Schedule\Exception
    */
    public function testMonthValidatesHighestValue()
    {
        $this->givenAValueThatIsTooHigh();
        $month = new Month($this->value);
    }
}

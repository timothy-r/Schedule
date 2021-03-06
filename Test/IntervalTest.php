<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Value\Interval;
use Ace\Schedule\Value\Range;

/*
* @group unit
* @group schedule
*/
class IntervalTestCase extends \PHPUnit_Framework_TestCase {

	public function testIntervalContainsManyValues() {
		//notated as '2-20/2' by cron schedule
		$interval_value = new Interval(new Range(4, 20), 2);
		$result = $interval_value->contains(4);
		$this->assertTrue($result, "Expected Interval(4, 20, 2) to match '4'");
		$result = $interval_value->contains(6);
		$this->assertTrue($result, "Expected Interval(4, 20, 2) to match '6'");
		$result = $interval_value->contains(8);
		$this->assertTrue($result, "Expected Interval(4, 20, 2) to match '8'");
		$result = $interval_value->contains(20);
		$this->assertTrue($result, "Expected Interval(4, 20, 2) to match '20'");
	}

	public function testIntervalDoesNotContainValue() {
		$interval_value = new Interval(new Range(4, 20), 2);
		$result = $interval_value->contains(2);
		$this->assertFalse($result, "Did not expected Interval(4, 20, 5) to match '4'" );
	}

    public function testIntervalMin()
    {
        $min = 13;
        $max = 18;
		$interval = new Interval(new Range($min, $max), 2);
        $this->assertSame($min, $interval->min());
    }

    public function testIntervalMax()
    {
        $min = 3;
        $max = 24;
		$interval = new Interval(new Range($min, $max), 2);
        $this->assertSame($max, $interval->max());
    }

    public function getGreaterThanFixtures()
    {
        return array(
            array(13, 18, 20, false),
            array(13, 18, 10, true),
        );
    }

    /**
    * @dataProvider getGreaterThanFixtures
    */
    public function testIntervalGreaterThan($min, $max, $test, $result)
    {
		$interval = new Interval(new Range($min, $max), 2);
        $this->assertSame($result, $interval->greaterThan($test));
    }

    public function getLessThanFixtures()
    {
        return array(
            array(13, 18, 20, true),
            array(13, 18, 10, false),
        );
    }

    /**
    * @dataProvider getLessThanFixtures
    */
    public function testIntervalLessThan($min, $max, $test, $result)
    {
		$interval = new Interval(new Range($min, $max), 2);
        $this->assertSame($result, $interval->lessThan($test));
    }
}

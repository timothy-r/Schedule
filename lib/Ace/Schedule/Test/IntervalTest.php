<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Value\Interval;
use Ace\Schedule\Value\Range;

require_once(dirname(__FILE__)."/../iValue.php");
require_once(dirname(__FILE__)."/../Value/Interval.php");

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
}

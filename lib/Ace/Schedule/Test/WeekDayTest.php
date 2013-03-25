<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Item\WeekDay;
use Ace\Schedule\Value\Literal;

require_once(dirname(__FILE__)."/../Item/iMatcher.iface.php");
require_once(dirname(__FILE__)."/../Item/WeekDay.class.php");

/**
* @group unit
*/
class WeekDayTestCase extends \PHPUnit_Framework_TestCase {
	
	public function testWeekDayMatchesValue() {
		for ($week_day = 0; $week_day < 7; $week_day++) {
			$matcher = new WeekDay(new Literal($week_day));
			//13 May 2012 is a Sunday, 0 == Sunday
			$date_string = "2012-05-" . (13 + $week_day);
			$date_time = new \DateTime($date_string);
			$result = $matcher->matches($date_time);
			$this->assertTrue($result, "Expected '$week_day' to match '$date_string'");
		}
	}

	public function testWeekDayDoesNotMatchValue() {
		$week_day = 1; //a Monday
		$matcher = new WeekDay(new Literal($week_day + 5));
		//13 May 2012 is a Sunday
		$date_string = "2012-05-" . (13 + $week_day);
		$date_string = "2012-$week_day-18";
		$date_time = new \DateTime($date_string);
		$result = $matcher->matches($date_time);
		$this->assertFalse($result, "Did not expected '$week_day+1' to match '$date_string'");
	}
}

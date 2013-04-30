<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Item\Hour;
use Ace\Schedule\Value\Literal;

require_once(dirname(__FILE__)."/../Item/iMatcher.php");
require_once(dirname(__FILE__)."/../Item/Hour.php");

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
}

<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Item\Minute;
use Ace\Schedule\Value\Literal;
use Ace\Schedule\Value\Range;

require_once(dirname(__FILE__)."/../Item/iMatcher.php");
require_once(dirname(__FILE__)."/../Item/Minute.php");

/**
* @group unit
* @group schedule
*/
class MinuteTestCase extends \PHPUnit_Framework_TestCase {
	
	public function testMinuteMatchesValue() {
		$minute = new Literal(5);
		$matcher = new Minute($minute);
		$date_string = "2012-05-18 20:05:00";
		$date_time = new \DateTime($date_string);
		$result = $matcher->matches($date_time);
		$this->assertTrue($result, "Expected '5' to match '$date_string'");
	}

	public function testMinuteDoesNotMatchValue() {
		$matcher = new Minute(new Literal(39));
		$date_string = "2012-05-18 20:01:00";
		$date_time = new \DateTime($date_string);
		$result = $matcher->matches($date_time);
		$this->assertFalse($result, "Did not expected '39' to match '$date_string'");
	}

	public function testAsteriskMatchesEveryMinute() {
		for ($i = 0; $i < 60; $i++) {
			$matcher = new Minute(new Range(0,59));
			$date_string = "2012-05-18 20:$i:00";
			$date_time = new \DateTime($date_string);
			$result = $matcher->matches($date_time);
			$this->assertTrue($result, "Expected '*' to match '$date_string'");
		}
	}

	public function getMatchingPatterns() {
		return array(
			array(5, '*'),	
		);
	}

	/**
	* @dataProvider getMatchingPatterns
	*/
	public function testMinuteMatchesPattern($minute, $pattern) {
			#$matcher = new Minute($pattern);
			#$date_time = new \DateTime("2012-05-08 20:$minute:02");
			#$result = $matcher->matches($date_time);
		#	$this->assertTrue($result, "Expected '$pattern' to match '$minute' minutes");
	}
}

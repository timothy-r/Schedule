<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\CronTab;
require_once(dirname(__FILE__)."/../CronTab.class.php");

/**
* @group unit
*/
class CronTabTestCase extends \PHPUnit_Framework_TestCase {
	public function getMatchingDatesAndPatterns() {
		return array(
			array(new \DateTime('2010-06-21 22:13:00'), "* 22 20,21,22,23 * *"),
			array(new \DateTime('2010-06-21 22:13:00'), "13,14,15 22 * * *"),
			array(new \DateTime('1999-10-04 12:49:00'), "* 12 * 6-12 *"),
			array(new \DateTime('1999-10-06 12:31:00'), "* 12 * 9,10,11 *"),
			array(new \DateTime('1999-10-08 12:49:00'), "40-50 * 2-12/2 * *"),
			array(new \DateTime('1999-10-22 12:49:00'), "* * */2 * *"), // every second day
			array(new \DateTime('1999-10-19 12:49:00'), "40-50 12 * * *"),
			array(new \DateTime('1999-10-03 12:48:00'), "40-50/2 12 * * *"),
		);
	}

	/**
	* @dataProvider getMatchingDatesAndPatterns
	*/
	public function testMatchesPattern($date_time, $pattern) {
		$cron = new CronTab($pattern);
		$result = $cron->matches($date_time);
		$this->assertTrue($result, "Expected '$pattern' to match " . $date_time->format('Y-m-d h:i:s'));
	}

	public function getNonMatchingDateAndPatterns() {
		return array(
			array(new \DateTime('2010-06-21 22:13:00'), "4 9 * * *"),
			array(new \DateTime('2010-06-21 22:13:00'), "* 13 10 * *"),
			array(new \DateTime('1999-10-06 12:49:00'), "* * 7 * *")
		);
	}

	/**
	* @dataProvider getNonMatchingDateAndPatterns
	*/
	public function testNonMatchingPatternIsNotMatched($date_time, $pattern) {
		$cron = new CronTab($pattern);
		$result = $cron->matches($date_time);
		$this->assertFalse($result, "Did not expected $pattern to match " . $date_time->format('Y-m-d h:m:i'));
	}

	public function testScheduleValidation() {
		$schedule = '13,14,15 22 * * *';
		$cron = new CronTab($schedule);
		$result = $cron->isValid();
		$this->assertTrue($result, "Expected '$schedule' to be valid");
	}

	public function getInvalidSchedules() {
		return array(
			array('abcdefg'),
		);
	}

	/**
	* @dataProvider getInvalidSchedules
	*/
	public function testInvalidScheduleIsDetected($invalid) {
		$cron = new CronTab($invalid);
		$result = $cron->isValid();
		$this->assertFalse($result, "Expected '$schedule' to be invalid");
	}
}

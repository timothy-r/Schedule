<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Entry;

/**
* @group unit
* @group schedule
*/
class EntryTestCase extends \PHPUnit_Framework_TestCase {
	public function testMatchesPattern() {
		$date_time = new \DateTime('2010-06-21 22:13:00');
		$matcher = $this->getMock('Mock_Matcher', array('matches'));
		$matcher->expects($this->any())
			->method('matches')
			->will($this->returnValue(true));

		$cron = new Entry(array($matcher));
		$result = $cron->matches($date_time);
		$this->assertTrue($result);
	}

	public function testNonMatchingPatternIsNotMatched() {
		$date_time = new \DateTime('2010-06-21 22:13:00');
		$matcher = $this->getMock('Mock_Matcher', array('matches'));
		$matcher->expects($this->any())
			->method('matches')
			->will($this->returnValue(false));

		$cron = new Entry(array($matcher));
		$result = $cron->matches($date_time);
		$this->assertFalse($result);
	}
}

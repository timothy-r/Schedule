<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Entry;
use Ace\Schedule\Test\MockTrait;

/**
* @group unit
* @group schedule
*/
class EntryTestCase extends \PHPUnit_Framework_TestCase
{
    use MockTrait;

	public function testMatchesPattern() {
		$date_time = new \DateTime('2010-06-21 22:13:00');
		$matcher = $this->createMock('Mock_Matcher', array('matches' => true));

		$cron = new Entry(array($matcher));
		$result = $cron->matches($date_time);
		$this->assertTrue($result);
	}

	public function testNonMatchingPatternIsNotMatched() {
		$date_time = new \DateTime('2010-06-21 22:13:00');
		$matcher = $this->createMock('Mock_Matcher', array('matches' => false));

		$cron = new Entry(array($matcher));
		$result = $cron->matches($date_time);
		$this->assertFalse($result);
	}
}

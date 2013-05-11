<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Calendar\Director;
use Ace\Schedule\iBuilder;

require_once(dirname(__FILE__)."/Stub_Builder.php");

/**
* @group unit
* @group schedule
*/
class CalendarDirectorTest extends \PHPUnit_Framework_TestCase
{
	public function testCreateCallsBuilderMethods()
	{
		$schedule = '2001-06-25 23:11:01';
		$builder = $this->getMock('Ace\Schedule\Test\Stub_Builder',
				array('buildMinute', 'buildHour', 'buildDay', 'buildMonth')
		);
		$builder->expects($this->once())
			->method('buildMinute')
			->with($this->equalTo('11'));
		$builder->expects($this->once())
			->method('buildHour')
			->with($this->equalTo('23'));

		$builder->expects($this->once())
			->method('buildDay')
			->with($this->equalTo('25'));

		$builder->expects($this->once())
			->method('buildMonth')
			->with($this->equalTo('6'));

		$director = new Director();
		$director->setBuilder($builder);
		$director->create($schedule);
	}

	public function testInvalidScheduleThrowsException()
	{
		$schedule = 'abcd-e3r5';
		$builder = $this->getMock('Ace\Schedule\Test\Stub_Builder',
				array('buildMinute', 'buildHour', 'buildDay', 'buildMonth', 'buildWeekDay')
		);
		$director = new Director();
		$director->setBuilder($builder);
		$this->setExpectedException('Ace\Schedule\Exception');
		$result = $director->create($schedule);
	}

	public function testMissingBuilderThrowsException()
	{
		$schedule = '2013-05-11 10:17:29';
		$director = new Director();
		$this->setExpectedException('Ace\Schedule\Exception');
		$result = $director->create($schedule);
	}
}

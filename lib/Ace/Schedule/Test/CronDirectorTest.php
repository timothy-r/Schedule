<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Cron\Director;
use Ace\Schedule\iBuilder;

require_once(dirname(__FILE__)."/Stub_Builder.php");
require_once(dirname(__FILE__)."/../iBuilder.php");
require_once(dirname(__FILE__)."/../Cron/Director.php");

/**
* @group unit
* @group schedule
*/
class CronDirectorTest extends \PHPUnit_Framework_TestCase
{
	public function testCreateCallsBuilderMethods()
	{
		$schedule = '4 * * * *';
		$builder = $this->getMock('Ace\Schedule\Test\Stub_Builder',
				array('buildMinute', 'buildHour', 'buildDay', 'buildMonth', 'buildWeekDay')
		);
		$builder->expects($this->once())
			->method('buildMinute')
			->with($this->equalTo('4'));
		$builder->expects($this->once())
			->method('buildHour')
			->with($this->equalTo('*'));

		$builder->expects($this->once())
			->method('buildDay')
			->with($this->equalTo('*'));

		$builder->expects($this->once())
			->method('buildMonth')
			->with($this->equalTo('*'));

		$builder->expects($this->once())
			->method('buildWeekDay')
			->with($this->equalTo('*'));

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
		$schedule = '';
		$director = new Director();
		$this->setExpectedException('Ace\Schedule\Exception');
		$result = $director->create($schedule);
	}
}
/*
class Stub_Builder implements iBuilder
{
	public function buildMinute($value){}
	public function buildHour($value){}
	public function buildDay($value){}
	public function buildMonth($value){}
	public function buildWeekDay($value){}
	public function getMatchers(){}
}*/

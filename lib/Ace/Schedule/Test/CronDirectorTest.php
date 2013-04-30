<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Cron\Director;
use Ace\Schedule\iBuilder;

require_once(dirname(__FILE__)."/../iBuilder.iface.php");
require_once(dirname(__FILE__)."/../Cron/Director.class.php");

/**
* @group unit
* @group schedule
*/
class CronDirectorTest extends \PHPUnit_Framework_TestCase
{
	public function testCreateReturnsArray()
	{
		$schedule = '4 * * * *';
		$builder = new Stub_Builder;
		$director = new Director($builder);
		$result = $director->create($schedule);
		$this->assertTrue(is_array($result));
	}

	public function testCreateCallsBuilderMethods()
	{
		$schedule = '4 * * * *';
		$builder = $this->getMock('Ace\Schedule\Test\Stub_Builder',
				array('buildMinute', 'buildHour', 'buildDay', 'buildMonth', 'buildWeekDay')
		);
		$builder->expects($this->once())
			->method('buildMinute')
			->with($this->equalTo('4'))
			->will($this->returnValue('min'));
		$builder->expects($this->once())
			->method('buildHour')
			->with($this->equalTo('*'))
			->will($this->returnValue('hour'));

		$builder->expects($this->once())
			->method('buildDay')
			->with($this->equalTo('*'))
			->will($this->returnValue('day'));

		$builder->expects($this->once())
			->method('buildMonth')
			->with($this->equalTo('*'))
			->will($this->returnValue('month'));

		$builder->expects($this->once())
			->method('buildWeekDay')
			->with($this->equalTo('*'))
			->will($this->returnValue('week-day'));

		$director = new Director($builder);
		$result = $director->create($schedule);
		$this->assertTrue(is_array($result));
	}
}

class Stub_Builder implements iBuilder
{
	public function buildMinute($value){}
	public function buildHour($value){}
	public function buildDay($value){}
	public function buildMonth($value){}
	public function buildWeekDay($value){}
}

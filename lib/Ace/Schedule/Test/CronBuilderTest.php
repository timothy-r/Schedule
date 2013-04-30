<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Cron\Builder;
use Ace\Schedule\iBuilder;

require_once(dirname(__FILE__)."/../iBuilder.iface.php");
require_once(dirname(__FILE__)."/../Cron/Builder.php");

/**
* @group unit
* @group schedule
*/
class CronBuilderTest extends \PHPUnit_Framework_TestCase
{
	public function testBuildMinute()
	{
		$value = '*';
		$builder = new Builder;
		$minute = $builder->buildMinute($value);
		$this->assertInstanceOf('Ace\Schedule\Item\Minute', $minute);
	}

	public function testBuildHour()
	{
		$value = '*';
		$builder = new Builder;
		$hour = $builder->buildHour($value);
		$this->assertInstanceOf('Ace\Schedule\Item\Hour', $hour);
	}

	public function testBuildDay()
	{
		$value = '*';
		$builder = new Builder;
		$day = $builder->buildDay($value);
		$this->assertInstanceOf('Ace\Schedule\Item\Day', $day);
	}

	public function testBuildMonth()
	{
		$value = '*';
		$builder = new Builder;
		$month = $builder->buildMonth($value);
		$this->assertInstanceOf('Ace\Schedule\Item\Month', $month);
	}

	public function testBuildWeekDay()
	{
		$value = '*';
		$builder = new Builder;
		$week_day = $builder->buildWeekDay($value);
		$this->assertInstanceOf('Ace\Schedule\Item\WeekDay', $week_day);
	}
}


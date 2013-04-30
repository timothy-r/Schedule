<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Cron\Builder;
use Ace\Schedule\iBuilder;

require_once(dirname(__FILE__)."/../iBuilder.php");
require_once(dirname(__FILE__)."/../Cron/Builder.php");

/**
* @group unit
* @group schedule
*/
class CronBuilderTest extends \PHPUnit_Framework_TestCase
{
	public function getValidMinuteFixtures()
	{
		return array(
			array('*'),
			array('?'),
			array('0'),
			array('1-15'),
			array('5,12,19,27,39'),
			array('59'),
		);
	}

	/**
	* @dataProvider getValidMinuteFixtures
	*/
	public function testBuildMinute($value)
	{
		$builder = new Builder;
		$minute = $builder->buildMinute($value);
		$this->assertInstanceOf('Ace\Schedule\Item\Minute', $minute);
	}

	public function getValidHourFixtures()
	{
		return array(
			array('*'),
			array('?'),
			array('0'),
			array('23'),
			array('0-12')
		);
	}

	/**
	* @dataProvider getValidHourFixtures
	*/
	public function testBuildHour($value)
	{
		$builder = new Builder;
		$hour = $builder->buildHour($value);
		$this->assertInstanceOf('Ace\Schedule\Item\Hour', $hour);
	}

	public function getValidDayFixtures()
	{
		return array(
			array('*'),
			array('?'),
			array('12'),
			array('30')
		);
	}

	/**
	* @dataProvider getValidDayFixtures
	*/
	public function testBuildDay($value)
	{
		$builder = new Builder;
		$day = $builder->buildDay($value);
		$this->assertInstanceOf('Ace\Schedule\Item\Day', $day);
	}

	public function getValidMonthFixtures()
	{
		return array(
			array('*'),
			array('?'),
			array('1'),
			array('1-6'),
			array('5,10'),
			array('12'),
		);
	}

	/**
	* @dataProvider getValidMonthFixtures
	*/
	public function testBuildMonth($value)
	{
		$builder = new Builder;
		$month = $builder->buildMonth($value);
		$this->assertInstanceOf('Ace\Schedule\Item\Month', $month);
	}

	public function getValidWeekDayFixtures()
	{
		return array(
			array('*'),
			array('?'),
			array('1'),
			array('0-3'),
			array('2,3,4'),
			array('6'),
			array('MONDAY'),
			array('Monday-Friday'),
			array('Thursday,Friday,Saturday'),
		);
	}

	/**
	* @dataProvider getValidWeekDayFixtures
	*/
	public function testBuildWeekDay($value)
	{
		$builder = new Builder;
		$week_day = $builder->buildWeekDay($value);
		$this->assertInstanceOf('Ace\Schedule\Item\WeekDay', $week_day);
	}
}


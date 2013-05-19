<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Builder;
use Ace\Schedule\IBuilder;
use Ace\Schedule\Value\Range;

/**
* @group integration
* @group schedule
*/
class BuilderTest extends \PHPUnit_Framework_TestCase
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
	*/
	public function testBuildMinute()
	{
		$builder = new Builder;
        $value = new Stub_Value;
		$builder->buildMinute($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\Minute', current($product));
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
	*/
	public function testBuildHour()
	{
		$builder = new Builder;
        $value = new Stub_Value;
		$builder->buildHour($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\Hour', current($product));
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
	*/
	public function testBuildDay()
	{
		$builder = new Builder;
        $value = new Stub_Value;
		$builder->buildDay($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\Day', current($product));
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
	*/
	public function testBuildMonth()
	{
		$builder = new Builder;
        $value = new Stub_Value;
		$builder->buildMonth($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\Month', current($product));
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
	*/
	public function testBuildWeekDay()
	{
		$builder = new Builder;
        $value = new Stub_Value;
		$builder->buildWeekDay($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\WeekDay', current($product));
	}
}

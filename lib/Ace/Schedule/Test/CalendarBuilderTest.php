<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Calendar\Builder;
use Ace\Schedule\iBuilder;

require_once(dirname(__FILE__)."/../iBuilder.php");
require_once(dirname(__FILE__)."/../Calendar/Builder.php");

/**
* @group unit
* @group schedule
*/
class CalendarBuilderTest extends \PHPUnit_Framework_TestCase
{
	public function getValidMinuteFixtures()
	{
		return array(
			array('0'),
			array('15'),
			array('59'),
		);
	}

	/**
	* @dataProvider getValidMinuteFixtures
	*/
	public function testBuildMinute($value)
	{
		$builder = new Builder;
		$builder->buildMinute($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\Minute', current($product));
	}

	public function getInvalidMinuteFixtures()
	{
		return array(
			array('s'),
			array(''),
			array(array()),
		);
	}

	/**
	* @dataProvider getInvalidMinuteFixtures
	*/
	public function testBuildMinuteThrowsExceptionForInvalidTokens($value)
	{
		$builder = new Builder;
		$this->setExpectedException('Ace\Schedule\Exception');
		$builder->buildMinute($value);
	}

	public function getValidHourFixtures()
	{
		return array(
			array('0'),
			array('23'),
		);
	}

	/**
	* @dataProvider getValidHourFixtures
	*/
	public function testBuildHour($value)
	{
		$builder = new Builder;
		$builder->buildHour($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\Hour', current($product));
	}

	public function getValidDayFixtures()
	{
		return array(
			array('1'),
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
		$builder->buildDay($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\Day', current($product));
	}

	public function getValidMonthFixtures()
	{
		return array(
			array('1'),
			array('6'),
			array('12'),
		);
	}

	/**
	* @dataProvider getValidMonthFixtures
	*/
	public function testBuildMonth($value)
	{
		$builder = new Builder;
		$builder->buildMonth($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\Month', current($product));
	}

	public function getValidWeekDayFixtures()
	{
		return array(
			array('1'),
			array('6'),
		);
	}

	/**
	* @dataProvider getValidWeekDayFixtures
	*/
	public function testBuildWeekDay($value)
	{
		$builder = new Builder;
		$builder->buildWeekDay($value);
		$product = $builder->getMatchers();
		$this->assertInstanceOf('Ace\Schedule\Item\WeekDay', current($product));
	}
}

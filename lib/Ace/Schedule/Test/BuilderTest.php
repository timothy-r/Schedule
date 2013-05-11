<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Builder;
use Ace\Schedule\iBuilder;
use Ace\Schedule\Value\Range;

require_once(dirname(__FILE__)."/../iBuilder.php");
require_once(dirname(__FILE__)."/../Builder.php");

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

    public function testCreateWildCard()
    {
		$builder = new Builder;
        $product = $builder->createWildCard();
		$this->assertInstanceOf('Ace\Schedule\Value\WildCard', $product);
    }

    public function testCreateLiteral()
    {
		$builder = new Builder;
        $product = $builder->createLiteral(3);
		$this->assertInstanceOf('Ace\Schedule\Value\Literal', $product);
        $this->assertTrue($product->min() == 3);
        $this->assertTrue($product->max() == 3);
    }

    public function testCreateRange()
    {
		$builder = new Builder;
        $product = $builder->createRange(3, 8);
		$this->assertInstanceOf('Ace\Schedule\Value\Range', $product);
        $this->assertTrue($product->min() == 3);
        $this->assertTrue($product->max() == 8);
    }

    public function testCreateAList()
    {
		$builder = new Builder;
        $product = $builder->createAList(array(3, 2, 8));
		$this->assertInstanceOf('Ace\Schedule\Value\AList', $product);
        $this->assertTrue($product->min() == 2);
        $this->assertTrue($product->max() == 8);
    }

    public function testCreateInterval()
    {
		$builder = new Builder;
        $value = new Range(4,18);
        $product = $builder->createInterval($value, 2);
		$this->assertInstanceOf('Ace\Schedule\Value\Interval', $product);
        $this->assertTrue($product->min() == 4);
        $this->assertTrue($product->max() == 18);
    }
}


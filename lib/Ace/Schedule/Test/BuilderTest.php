<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Builder;
use Ace\Schedule\Value\Range;

use Ace\Schedule\Item\Minute;
use Ace\Schedule\Item\Hour;
use Ace\Schedule\Item\Day;
use Ace\Schedule\Item\Month;
use Ace\Schedule\Item\WeekDay;

use Ace\Schedule\Test\MockTrait;

/**
* @group integration
* @group schedule
*/
class BuilderTest extends \PHPUnit_Framework_TestCase
{
    use MockTrait;

	public function testBuilderCreatesEntry()
	{
        $value = new StubValue;
		$builder = new Builder;
		$builder->buildMinute($value);
		$product = $builder->getProduct();
        $this->assertInstanceOf('Ace\Schedule\Entry', $product);
	}

	public function testBuildMinute()
	{
        $value = new StubValue;
        $min = new Minute($value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $min]);

		$builder->buildMinute($value);
		$product = $builder->getProduct();
	}

	/**
	*/
	public function testBuildHour()
	{
        $value = new StubValue;
        $hour = new Hour($value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $hour]);

		$builder->buildHour($value);
		$product = $builder->getProduct();
	}

	/**
	*/
	public function testBuildDay()
	{
        $value = new StubValue;
        $day = new Day($value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $day]);

		$builder->buildDay($value);
		$product = $builder->getProduct();
	}

	/**
	*/
	public function testBuildMonth()
	{
        $value = new StubValue;
        $month = new Month($value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $month]);

		$builder->buildMonth($value);
		$product = $builder->getProduct();
	}

	/**
	*/
	public function testBuildWeekDay()
	{
        $value = new StubValue;
        $week_day = new WeekDay($value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $week_day]);

		$builder->buildWeekDay($value);
		$product = $builder->getProduct();
	}
}

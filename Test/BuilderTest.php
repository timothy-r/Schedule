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
        $this->givenAMockValue();
		$builder = new Builder;
		$builder->buildMinute($this->value);
		$product = $builder->getProduct();
        $this->assertInstanceOf('Ace\Schedule\Entry', $product);
	}

	public function testBuildMinute()
	{
        $this->givenAMockValue();
        $min = new Minute($this->value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $min]);

		$builder->buildMinute($this->value);
		$product = $builder->getProduct();
	}

	/**
	*/
	public function testBuildHour()
	{
        $this->givenAMockValue();
        $hour = new Hour($this->value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $hour]);

		$builder->buildHour($this->value);
		$product = $builder->getProduct();
	}

	/**
	*/
	public function testBuildDay()
	{
        $this->givenAMockValue();
        $day = new Day($this->value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $day]);

		$builder->buildDay($this->value);
		$product = $builder->getProduct();
	}

	/**
	*/
	public function testBuildMonth()
	{
        $this->givenAMockValue();
        $month = new Month($this->value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $month]);

		$builder->buildMonth($this->value);
		$product = $builder->getProduct();
	}

	/**
	*/
	public function testBuildWeekDay()
	{
        $this->givenAMockValue();
        $week_day = new WeekDay($this->value);
		$builder = $this->createMock('Ace\Schedule\Builder',['createEntry' => $week_day]);

		$builder->buildWeekDay($this->value);
		$product = $builder->getProduct();
	}
}

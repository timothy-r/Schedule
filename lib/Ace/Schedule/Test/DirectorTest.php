<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Director;
use Ace\Schedule\IBuilder;

/**
* @group unit
* @group schedule
*/
class DirectorTest extends \PHPUnit_Framework_TestCase
{
    /**
    */
	public function testCreateCallsBuilderMethods()
	{
		$schedule = '*/2 * 1,2 3-6 Monday';
		$builder = $this->getMock('Ace\Schedule\Test\StubBuilder',
			array('buildMinute', 'buildHour', 'buildDay', 'buildMonth', 'buildWeekDay')
		);
        
        $parser = $this->getMock('Ace\Schedule\Test\StubParser',
            array('parse', 'getMinute', 'getHour', 'getDay', 'getMonth', 'getWeekDay', 'getYear')
        );
        
        $parser->expects($this->atLeastOnce())
            ->method('parse')
            ->will($this->returnValue(true));

        $stub_value = new Stub_Value;
        $parser->expects($this->any())
            ->method('getMinute')
            ->will($this->returnValue($stub_value));

        $parser->expects($this->any())
            ->method('getHour')
            ->will($this->returnValue($stub_value));

        $parser->expects($this->any())
            ->method('getDay')
            ->will($this->returnValue($stub_value));

        $parser->expects($this->any())
            ->method('getMonth')
            ->will($this->returnValue($stub_value));

        $parser->expects($this->any())
            ->method('getWeekDay')
            ->will($this->returnValue($stub_value));

		$builder->expects($this->once())
			->method('buildMinute')
            ->with($this->equalTo($stub_value));

		$builder->expects($this->once())
			->method('buildHour')
            ->with($this->equalTo($stub_value));

		$builder->expects($this->once())
			->method('buildDay')
            ->with($this->equalTo($stub_value));

		$builder->expects($this->once())
			->method('buildMonth')
            ->with($this->equalTo($stub_value));

		$builder->expects($this->once())
			->method('buildWeekDay')
            ->with($this->equalTo($stub_value));

		$director = new Director();
		$director->setBuilder($builder);
        $director->setParser($parser);
		$director->create($schedule);
	}

    public function testInvalidScheduleThrowsException()
    {
        $parser = $this->getMock('Ace\Schedule\Test\StubParser',
            array('parse', 'getMinute', 'getHour', 'getDay', 'getMonth', 'getWeekDay', 'getYear')
        );
        
        $parser->expects($this->atLeastOnce())
            ->method('parse')
            ->will($this->returnValue(false));
        $builder = new StubBuilder;
		$director = new Director();
		$director->setBuilder($builder);
        $director->setParser($parser);
		$this->setExpectedException('Ace\Schedule\Exception');
        $schedule = '$4q * * * *';
		$result = $director->create($schedule);
    }

	public function testMissingBuilderThrowsException()
	{
		$schedule = '';
        $parser = new StubParser;
		$director = new Director();
        $director->setParser($parser);
		$this->setExpectedException('Ace\Schedule\Exception');
		$result = $director->create($schedule);
	}

	public function testMissingParserThrowsException()
	{
		$schedule = '';
        $builder = new StubBuilder;
		$director = new Director();
        $director->setBuilder($builder);
		$this->setExpectedException('Ace\Schedule\Exception');
		$result = $director->create($schedule);
	}
}

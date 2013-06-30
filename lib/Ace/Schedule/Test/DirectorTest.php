<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Director;
use Ace\Schedule\IBuilder;
use Ace\Schedule\Test\ScheduleTest;

/**
* @group unit
* @group schedule
*/
class DirectorTest extends ScheduleTest
{
    /**
    */
	public function testCreateCallsBuilderMethods()
	{
		$schedule = '*/2 * 1,2 3-6 Monday';
        $stub_value = new StubValue;
		$builder = $this->helper->createMock('Ace\Schedule\Test\StubBuilder',
			array(
            'buildMinute' => $stub_value, 
            'buildHour' => $stub_value,
            'buildDay' => $stub_value,
            'buildMonth' => $stub_value,
            'buildWeekDay' => $stub_value)
		);
        
        $parser = $this->helper->createMock('Ace\Schedule\Test\StubParser',
            array(
                'parse' => true,
                'getMinute' => $stub_value, 
                'getHour' => $stub_value, 
                'getDay' => $stub_value, 
                'getMonth' => $stub_value, 
                'getWeekDay' => $stub_value, 
                'getYear' => $stub_value)
        );
		$director = new Director();
		$director->setBuilder($builder);
        $director->setParser($parser);
		$director->create($schedule);
	}

    /**
    * @expectedException Ace\Schedule\Exception
    */
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
        $schedule = '$4q * * * *';
		$result = $director->create($schedule);
    }

    /**
    * @expectedException Ace\Schedule\Exception
    */
	public function testMissingBuilderThrowsException()
	{
		$director = new Director();
        $director->setParser(new StubParser);
		$result = $director->create('');
	}

    /**
    * @expectedException Ace\Schedule\Exception
    */
	public function testMissingParserThrowsException()
	{
		$director = new Director();
        $director->setBuilder(new StubBuilder);
		$result = $director->create('');
	}
}

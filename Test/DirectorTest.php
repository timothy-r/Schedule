<?php namespace Ace\Schedule\Test;

use Ace\Schedule\Director;
use Ace\Schedule\Exception;
use Ace\Schedule\Test\MockTrait;
use PHPUnit_Framework_TestCase;

/**
* @group unit
* @group schedule
*/
class DirectorTest extends PHPUnit_Framework_TestCase
{
    use MockTrait;

    /**
    */
	public function testCreateCallsBuilderMethods()
	{
		$schedule = '*/2 * 1,2 3-6 Monday';
        $this->givenAMockValue();
		$builder = $this->createMock('Ace\Schedule\BuilderInterface',
			array(
            'buildMinute' => $this->value, 
            'buildHour' => $this->value,
            'buildDay' => $this->value,
            'buildMonth' => $this->value,
            'buildWeekDay' => $this->value,
            'getProduct' => null)
		);
        
        $parser = $this->createMock('Ace\Schedule\ParserInterface',
            array(
                'parse' => true,
                'getMinute' => $this->value, 
                'getHour' => $this->value, 
                'getDay' => $this->value, 
                'getMonth' => $this->value, 
                'getWeekDay' => $this->value, 
                'getYear' => $this->value)
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
        $parser = $this->getMock('Ace\Schedule\ParserInterface',
            array('parse', 'getMinute', 'getHour', 'getDay', 'getMonth', 'getWeekDay', 'getYear')
        );
        
        $parser->expects($this->any())
            ->method('getMinute')
            ->will($this->throwException(new Exception));
        $parser->expects($this->any())
            ->method('getHour')
            ->will($this->throwException(new Exception));
        $parser->expects($this->any())
            ->method('getDay')
            ->will($this->throwException(new Exception));
        $parser->expects($this->any())
            ->method('getMonth')
            ->will($this->throwException(new Exception));
        $parser->expects($this->any())
            ->method('getWeekDay')
            ->will($this->throwException(new Exception));
        $parser->expects($this->any())
            ->method('getYear')
            ->will($this->throwException(new Exception));

        $this->givenAMockBuilder();

		$director = new Director();
		$director->setBuilder($this->builder);
        $director->setParser($parser);
        $schedule = '$4q * * * *';
		$result = $director->create($schedule);
    }

    /**
    * @expectedException Ace\Schedule\Exception
    */
	public function testMissingBuilderThrowsException()
	{
        $this->givenAMockParser();
		$director = new Director();
        $director->setParser($this->parser);
		$result = $director->create('');
	}

    /**
    * @expectedException Ace\Schedule\Exception
    */
	public function testMissingParserThrowsException()
	{
        $this->givenAMockBuilder();
		$director = new Director();
        $director->setBuilder($this->builder);
		$result = $director->create('');
	}
}

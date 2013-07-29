<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Factory;
use Ace\Schedule\IDirector;
use Ace\Schedule\IBuilder;
use Ace\Schedule\Exception;

/**
* @group unit
* @group schedule
*/
class FactoryUnitTest extends \PHPUnit_Framework_TestCase
{
	public function testCreateEntry()
	{
		$schedule = '4 * * * *';
        $type = 'type';
		$stub_director = new StubDirector();
		$stub_builder = new StubBuilder();
        $stub_parser = new StubParser;
		$factory = $this->getMock('Ace\Schedule\Factory', 
            array('getParser'), 
            array($stub_director, $stub_builder)
        );
        $factory->expects($this->any())
            ->method('getParser')
            ->will($this->returnValue($stub_parser));


		$entry = $factory->createEntry($schedule, $type);
		$this->assertInstanceOf('Ace\Schedule\Entry', $entry);
	}

    /**
    * @expectedException Ace\Schedule\Exception
    */
	public function testCreateEntryThrowsExceptionWithInvalidType()
	{
		$schedule = '14th May 2013';
        $type = 'null';
		$stub_director = new StubDirector();
		$stub_builder = new StubBuilder();
        $factory = new Factory($stub_director, $stub_builder);

		$entry = $factory->createEntry($schedule, $type);
	}
}

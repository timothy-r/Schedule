<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Factory;
use Ace\Schedule\iDirector;
use Ace\Schedule\iBuilder;
use Ace\Schedule\Exception;

require_once(dirname(__FILE__)."/Stub_Builder.php");
require_once(dirname(__FILE__)."/Stub_Director.php");

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
		$stub_director = new Stub_Director();
		$stub_builder = new Stub_Builder();
        $stub_parser = new Stub_Parser;
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

	public function testCreateEntryThrowsExceptionWithInvalidType()
	{
		$schedule = '14th May 2013';
        $type = 'null';
		$stub_director = new Stub_Director();
		$stub_builder = new Stub_Builder();
        $factory = new Factory($stub_director, $stub_builder);

		$this->setExpectedException('Ace\Schedule\Exception');
		$entry = $factory->createEntry($schedule, $type);
	}
}
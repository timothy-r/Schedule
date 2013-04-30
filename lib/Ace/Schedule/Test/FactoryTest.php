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
class FactoryTest extends \PHPUnit_Framework_TestCase
{
	public function testCreateEntry()
	{
		$schedule = '4 * * * *';
		$stub_director = new Stub_Director();
		$stub_builder = new Stub_Builder();
		$factory = new Factory($stub_director, $stub_builder);

		$entry = $factory->createEntry($schedule);
		$this->assertInstanceOf('Ace\Schedule\Entry', $entry);
	}

	public function testCreateEntryThrowsExceptionWithInvalidData()
	{
		$schedule = 'not-a-crontab-string';
		$mock_director = $this->getMock('Ace\Schedule\Test\Stub_Director', array('create'));
		$mock_director->expects($this->any())
			->method('create')
			->will($this->throwException(new Exception));

		$stub_builder = new Stub_Builder();
		$factory = new Factory($mock_director, $stub_builder);
		$this->setExpectedException('Ace\Schedule\Exception');
		$entry = $factory->createEntry($schedule);
	}
}

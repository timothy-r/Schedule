<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Factory;
use Ace\Schedule\iDirector;
use Ace\Schedule\Exception;

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
		$factory = new Factory($stub_director);
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

		$factory = new Factory($mock_director);
		$this->setExpectedException('Ace\Schedule\Exception');
		$entry = $factory->createEntry($schedule);
	}
}

class Stub_Director implements iDirector
{
	public function create($schedule){
		return array();
	}
}

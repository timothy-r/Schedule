<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Cron\Factory;
use Ace\Schedule\iFactory;

require_once(dirname(__FILE__)."/../iBuilder.php");
require_once(dirname(__FILE__)."/../Cron/Factory.php");

/**
* @group unit
* @group schedule
*/
class CronFactoryTest extends \PHPUnit_Framework_TestCase
{
	public function testCreateEntry()
	{
		$schedule = '4 * * * *';
		$factory = new Factory;
		$entry = $factory->createEntry($schedule);
		$this->assertInstanceOf('Ace\Schedule\Entry', $entry);
	}
}


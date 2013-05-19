<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Factory;
use Ace\Schedule\iDirector;
use Ace\Schedule\Director;
use Ace\Schedule\IBuilder;
use Ace\Schedule\Builder;
use Ace\Schedule\Exception;
use \DateTime;

/**
* @group unit
* @group schedule
*/
class FactoryIntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function getValidScheduleData()
    {
        return array(
            array('*/2 1 * * *', 'cron', new DateTime('2013-01-01 01:02:00')),
            array('*/5 4 1 * *', 'cron', new DateTime('2013-01-01 04:10:00')),
            array('26th January 2013 8pm', 'calendar', new DateTime('2013-01-26 20:00:00')),
            array('26th January', 'calendar', new DateTime('2001-01-26')),
        );
    }

    /**
    * @dataProvider getValidScheduleData
    */
	public function testCreateEntry($schedule, $type, $expected)
	{
		$director = new Director();
		$builder = new Builder();
        $factory = new Factory($director, $builder);
		$entry = $factory->createEntry($schedule, $type);
		$this->assertInstanceOf('Ace\Schedule\Entry', $entry);
        $this->assertTrue($entry->matches($expected));
	}
}

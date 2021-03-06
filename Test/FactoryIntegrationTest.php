<?php namespace Ace\Schedule\Test;

use Ace\Schedule\Factory;
use Ace\Schedule\Director;
use Ace\Schedule\Builder;
use Ace\Schedule\Exception;
use Ace\Schedule\ParserFactory;
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
        $parser_factory = new ParserFactory();
        $factory = new Factory($director, $builder, $parser_factory);

		$entry = $factory->createEntry($schedule, $type);

        $this->assertInstanceOf('Ace\Schedule\Entry', $entry);
        $this->assertTrue($entry->matches($expected));
	}

    /**
     * @expectedException Ace\Schedule\Exception
     */
    public function testCreateEntryThrowsExceptionWithInvalidType()
    {
        $schedule = '14th May 2013';
        $type = 'null';
        $director = new Director();
        $builder = new Builder();
        $parser_factory = new ParserFactory();
        $factory = new Factory($director, $builder, $parser_factory);

        $entry = $factory->createEntry($schedule, $type);
    }
}

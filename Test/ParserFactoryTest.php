<?php namespace Ace\Schedule\Test;

use Ace\Schedule\ParserFactory;
use PHPUnit_Framework_TestCase;

/**
 * @author timrodger
 * Date: 02/03/15
 */

class ParserFactoryTest extends PHPUnit_Framework_TestCase
{
    public function getTypes()
    {
        return [
            ['cron', 'Ace\Schedule\Cron\Parser'],
            ['calendar', 'Ace\Schedule\Calendar\Parser']
        ];
    }

    /**
     * @dataProvider getTypes
     * @param $type
     * @param $expected
     */
    public function testCreate($type, $expected)
    {
        $factory = new ParserFactory();
        $parser = $factory->create($type);
        $this->assertSame($expected, get_class($parser));
    }

    /**
     * @expectedException Ace\Schedule\Exception
     */
    public function testCreateThrowsExceptionForUnknownType()
    {
        $type = 'unknown';
        $factory = new ParserFactory();
        $parser = $factory->create($type);
    }
}

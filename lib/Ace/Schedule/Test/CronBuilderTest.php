<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Cron\Builder;
use Ace\Schedule\iBuilder;

require_once(dirname(__FILE__)."/../iBuilder.iface.php");
require_once(dirname(__FILE__)."/../Cron/Builder.class.php");

/**
* @group unit
* @group schedule
*/
class CronBuilderTest extends \PHPUnit_Framework_TestCase
{
	
	public function testBuildMinute()
	{
		$value = '*';
		$builder = new Builder;
		$minute = $builder->buildMinute($value);
		$this->assertInstanceOf('Ace\Schedule\Item\iMatcher', $minute);
	}
}


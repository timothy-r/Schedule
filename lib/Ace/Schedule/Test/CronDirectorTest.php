<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Cron\Director;
use Ace\Schedule\iBuilder;

require_once(dirname(__FILE__)."/Stub_Builder.php");

/**
* @group unit
* @group schedule
*/
class CronDirectorTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @todo cover all builder methods
    */
	public function testCreateCallsBuilderMethods()
	{
		$schedule = '4 * * * *';
		$builder = $this->getMock('Ace\Schedule\Test\Stub_Builder',
				array('buildMinute', 'buildHour', 'buildDay', 'buildMonth', 'buildWeekDay',
                'createWildCard', 'createLiteral')
		);
        
        $stub_value = new Stub_Value;
		$builder->expects($this->any())
			->method('createWildCard')
            ->will($this->returnValue($stub_value));

		$builder->expects($this->any())
			->method('createLiteral')
            ->will($this->returnValue($stub_value));

		$builder->expects($this->once())
			->method('buildMinute')
            ->with($this->equalTo($stub_value));

		$builder->expects($this->once())
			->method('buildHour');

		$builder->expects($this->once())
			->method('buildDay');

		$builder->expects($this->once())
			->method('buildMonth');

		$builder->expects($this->once())
			->method('buildWeekDay');

		$director = new Director();
		$director->setBuilder($builder);
		$director->create($schedule);
	}

	public function testInvalidScheduleThrowsException()
	{
		$schedule = 'abcd-e3r5';
		$builder = $this->getMock('Ace\Schedule\Test\Stub_Builder',
				array('buildMinute', 'buildHour', 'buildDay', 'buildMonth', 'buildWeekDay')
		);
		$director = new Director();
		$director->setBuilder($builder);
		$this->setExpectedException('Ace\Schedule\Exception');
		$result = $director->create($schedule);
	}

	public function testMissingBuilderThrowsException()
	{
		$schedule = '';
		$director = new Director();
		$this->setExpectedException('Ace\Schedule\Exception');
		$result = $director->create($schedule);
	}
}

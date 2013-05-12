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
    */
	public function testCreateCallsBuilderMethods()
	{
		$schedule = '*/2 * 1,2 3-6 Monday';
		$builder = $this->getMock('Ace\Schedule\Test\Stub_Builder',
			array('buildMinute', 'buildHour', 'buildDay', 'buildMonth', 'buildWeekDay',
            'createWildCard', 'createLiteral', 'createAList', 'createRange', 'createInterval')
		);
        
        $stub_wildcard = new Stub_Value('wildcard');
        $stub_interval = new Stub_Value('interval');
        $stub_literal = new Stub_Value('literal');
        $stub_alist = new Stub_Value('alist');
        $stub_range = new Stub_Value('range');

		$builder->expects($this->any())
			->method('createWildCard')
            ->will($this->returnValue($stub_wildcard));

		$builder->expects($this->once())
			->method('createLiteral')
            ->will($this->returnValue($stub_literal));

		$builder->expects($this->once())
			->method('createInterval')
            ->will($this->returnValue($stub_interval));

		$builder->expects($this->once())
			->method('createRange')
            ->will($this->returnValue($stub_range));

		$builder->expects($this->once())
			->method('createAList')
            ->will($this->returnValue($stub_alist));

		$builder->expects($this->once())
			->method('buildMinute')
            ->with($this->equalTo($stub_interval));

		$builder->expects($this->once())
			->method('buildHour')
            ->with($this->equalTo($stub_wildcard));

		$builder->expects($this->once())
			->method('buildDay')
            ->with($this->equalTo($stub_alist));

		$builder->expects($this->once())
			->method('buildMonth')
            ->with($this->equalTo($stub_range));

		$builder->expects($this->once())
			->method('buildWeekDay')
            ->with($this->equalTo($stub_literal));

		$director = new Director();
		$director->setBuilder($builder);
		$director->create($schedule);
	}

    public function testInvalidScheduleItemThrowsException()
    {
        $schedule = '$4q * * * *';
		$builder = $this->getMock('Ace\Schedule\Test\Stub_Builder',
				array('buildMinute', 'buildHour', 'buildDay', 'buildMonth', 'buildWeekDay')
		);
		$director = new Director();
		$director->setBuilder($builder);
		$this->setExpectedException('Ace\Schedule\Exception');
		$result = $director->create($schedule);
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

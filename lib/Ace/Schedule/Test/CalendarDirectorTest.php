<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Calendar\Director;
use Ace\Schedule\iBuilder;

require_once(dirname(__FILE__)."/Stub_Builder.php");

/**
* @group unit
* @group schedule
*/
class CalendarDirectorTest extends \PHPUnit_Framework_TestCase
{
    public function getValidSchedules()
    {
        return array(
            array('2001-06-25 23:11:01'),
            array('25th June 2001 23:11'),
            array('June 25th 23:11'),
            array('June 25th 11:11pm'),
        );
    }

    /**
    * @dataProvider getValidSchedules
    */
	public function testCreateCallsBuilderMethods($schedule)
	{
		$builder = $this->getMock('Ace\Schedule\Test\Stub_Builder',
				array('buildMinute', 'buildHour', 'buildDay', 'buildMonth',
                'createLiteral')
		);
        $stub_value = new Stub_Value;

		$builder->expects($this->any())
			->method('createLiteral')
            ->will($this->returnValue($stub_value));

		$builder->expects($this->once())
			->method('buildMinute')
			->with($this->equalTo($stub_value));
		$builder->expects($this->once())
			->method('buildHour')
			->with($this->equalTo($stub_value));

		$builder->expects($this->once())
			->method('buildDay')
			->with($this->equalTo($stub_value));

		$builder->expects($this->once())
			->method('buildMonth')
			->with($this->equalTo($stub_value));

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
		$schedule = '2013-05-11 10:17:29';
		$director = new Director();
		$this->setExpectedException('Ace\Schedule\Exception');
		$result = $director->create($schedule);
	}
}

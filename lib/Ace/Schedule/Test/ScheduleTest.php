<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Test\TestHelper;
use Ace\Schedule\Test\MockTrait;

/**
* 
*/
class ScheduleTest extends \PHPUnit_Framework_TestCase
{
    use MockTrait;

    protected $value;

    protected function givenAValueThatIsTooLow()
    {
        $this->value = $this->createMock(
            'Ace\Schedule\Test\StubValue', 
            array('lessThan' => true, 'greaterThan' => false)
        );
    }

    protected function givenAValueThatIsTooHigh()
    {
        $this->value = $this->createMock(
            'Ace\Schedule\Test\StubValue', 
            array('lessThan' => false, 'greaterThan' => true)
        );
    }
}

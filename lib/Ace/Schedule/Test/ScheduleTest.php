<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\Test\TestHelper;

/**
* 
*/
class ScheduleTest extends \PHPUnit_Framework_TestCase
{
    /*
    * @var Ace\Schedule\Test\TestHelper
    */
    protected $helper;

    protected $value;

    public function setUp()
    {
        $this->helper = new TestHelper($this);
    }

    protected function givenAValueThatIsTooLow()
    {
        $this->value = $this->helper->createMock(
            'Ace\Schedule\Test\StubValue', 
            array('lessThan' => true, 'greaterThan' => false)
        );

    }

    protected function givenAValueThatIsTooHigh()
    {
        $this->value = $this->helper->createMock(
            'Ace\Schedule\Test\StubValue', 
            array('lessThan' => false, 'greaterThan' => true)
        );

    }
}

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

    public function setUp()
    {
        $this->helper = new TestHelper($this);
    }
}

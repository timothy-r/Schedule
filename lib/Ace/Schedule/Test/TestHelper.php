<?php
namespace Ace\Schedule\Test;
use PHPUnit_Framework_TestCase;

/**
* 
*/
class TestHelper 
{
    private $case;

    public function __construct(PHPUnit_Framework_TestCase $case)
    {
        $this->case = $case;
    }

    public function createMock($name, $method_and_return = array(), $args = array(), $class_name = '', $call_constructor = true)
    {
        $methods = array_keys($method_and_return);
        $mock = $this->case->getMock($name, $methods, $args, $class_name, $call_constructor);
        foreach($methods as $method){
            $mock->expects($this->case->any())
                ->method($method)
                ->will($this->case->returnValue($method_and_return[$method]));
        }
        return $mock;
    }
}

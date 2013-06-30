<?php
namespace Ace\Schedule\Test;
/**
* 
*/
class ScheduleTest extends \PHPUnit_Framework_TestCase
{
    public function createMock($name, $method_and_return = array(), $args = array(), $class_name = '', $call_constructor = true)
    {
        $methods = array_keys($method_and_return);
        $mock = $this->getMock($name, $methods, $args, $class_name, $call_constructor);
        foreach($methods as $method){
            $mock->expects($this->any())
                ->method($method)
                ->will($this->returnValue($method_and_return[$method]));
        }
        return $mock;
    }
}

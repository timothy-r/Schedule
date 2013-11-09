<?php
namespace Ace\Schedule\Test;
use PHPUnit_Framework_TestCase;

/**
*/
trait MockTrait 
{
    /**
    * @var string $name
    * @var array $method_and_returns
    * @var array args
    * @var string $class_name
    * @var boolean $call_constructor
    */
    public function createMock($name, array $method_and_return = [], array $args = [], $class_name = '', $call_constructor = true)
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

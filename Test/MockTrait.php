<?php namespace Ace\Schedule\Test;

/**
*/
trait MockTrait 
{

    protected $value;

    protected $builder;

    protected $parser;

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

    protected function givenAMockValue()
    {
        $this->value = $this->createMock(
            'Ace\Schedule\ValueInterface'
        );
    }

    protected function givenAMockBuilder()
    {
        $this->builder = $this->createMock(
            'Ace\Schedule\BuilderInterface'
        );
    }

    protected function givenAMockParser()
    {
        $this->parser = $this->createMock(
            'Ace\Schedule\ParserInterface'
        );
    }

    protected function givenAValueThatIsTooLow()
    {
        $this->value = $this->createMock(
            'Ace\Schedule\ValueInterface',
            array('lessThan' => true, 'greaterThan' => false, "contains" => null, "min" => null, "max" => null)
        );
    }

    protected function givenAValueThatIsTooHigh()
    {
        $this->value = $this->createMock(
            'Ace\Schedule\ValueInterface',
            array('lessThan' => false, 'greaterThan' => true, "contains" => null, "min" => null, "max" => null)
        );
    }
}

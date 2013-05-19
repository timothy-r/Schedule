<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\IValue;

/**
* @codeCoverageIgnore
*/
class Stub_Value implements IValue
{
    protected $id;

    public function __construct($id = 'id')
    {
        $this->id = $id;
    }

	public function contains($value){}
    public function min(){}
    public function max(){}
    public function greaterThan($value){}
    public function lessThan($value){}
}

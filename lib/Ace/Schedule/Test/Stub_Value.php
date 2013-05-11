<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\iValue;

class Stub_Value implements iValue
{
	public function contains($value){}
    public function min(){}
    public function max(){}
    public function greaterThan($value){}
    public function lessThan($value){}
}

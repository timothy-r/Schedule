<?php
namespace Ace\Schedule;
/**
* interface for classes that represent one or more values
*/
interface IValue {
	public function contains($value);
    public function min();
    public function max();
    public function greaterThan($value);
    public function lessThan($value);
}

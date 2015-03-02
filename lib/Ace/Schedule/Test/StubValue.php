<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\ValueInterface;

/**
* @codeCoverageIgnore
*/
class StubValue implements ValueInterface
{
    private $id;

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

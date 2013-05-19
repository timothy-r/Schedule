<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\iDirector;
use Ace\Schedule\IBuilder;
use Ace\Schedule\iParser;

/**
* @codeCoverageIgnore
*/
class Stub_Director implements iDirector
{
	public function create($schedule){}

	public function setBuilder(IBuilder $builder){}

    public function setParser(iParser $parser) {}
}

<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\IDirector;
use Ace\Schedule\IBuilder;
use Ace\Schedule\IParser;

/**
* @codeCoverageIgnore
*/
class Stub_Director implements IDirector
{
	public function create($schedule){}

	public function setBuilder(IBuilder $builder){}

    public function setParser(IParser $parser) {}
}

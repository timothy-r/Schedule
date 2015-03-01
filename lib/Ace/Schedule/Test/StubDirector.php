<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\IDirector;
use Ace\Schedule\BuilderInterface;
use Ace\Schedule\IParser;

/**
* @codeCoverageIgnore
*/
class StubDirector implements IDirector
{
	public function create($schedule){}

	public function setBuilder(BuilderInterface $builder){}

    public function setParser(IParser $parser) {}
}

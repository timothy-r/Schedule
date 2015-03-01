<?php namespace Ace\Schedule\Test;

use Ace\Schedule\DirectorInterface;
use Ace\Schedule\BuilderInterface;
use Ace\Schedule\ParserInterface;

/**
* @codeCoverageIgnore
*/
class StubDirector implements DirectorInterface
{
	public function create($schedule){}

	public function setBuilder(BuilderInterface $builder){}

    public function setParser(ParserInterface $parser) {}
}

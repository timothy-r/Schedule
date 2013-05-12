<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\iDirector;
use Ace\Schedule\iBuilder;

/**
* @codeCoverageIgnore
*/
class Stub_Director implements iDirector
{
	public function create($schedule){}

	public function setBuilder(iBuilder $builder){}
}

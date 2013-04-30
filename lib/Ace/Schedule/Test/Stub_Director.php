<?php
namespace Ace\Schedule\Test;
use Ace\Schedule\iDirector;
use Ace\Schedule\iBuilder;

class Stub_Director implements iDirector
{
	public function create($schedule){
		return array();
	}

	public function setBuilder(iBuilder $builder)
	{
	}
}

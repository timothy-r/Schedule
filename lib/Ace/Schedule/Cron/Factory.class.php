<?php
namespace Ace\Schedule\Cron;
use Ace\Schedule\iFactory;
use Ace\Schedule\Cron\Director;
use Ace\Schedule\Cron\Builder;

/**
*/
class Factory implements iFactory
{
	public function createEntry($schedule)
	{
		$builder = new Builder;
		$director = new Director($builder);
		// build schedule and inject into Entry
	}
}


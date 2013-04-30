<?php
namespace Ace\Schedule\Cron;
use Ace\Schedule\iFactory;
use Ace\Schedule\Entry;
use Ace\Schedule\Cron\Director;
use Ace\Schedule\Cron\Builder;

/**
* creates an Entry object for a given Cron schedule string
*/
class Factory implements iFactory
{
	public function createEntry($schedule)
	{
		$builder = new Builder;
		$director = new Director($builder);
		// build schedule and inject into Entry
		$matchers = $director->create($schedule);
		return new Entry($matchers);
	}
}


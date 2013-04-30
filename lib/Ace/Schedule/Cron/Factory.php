<?php
namespace Ace\Schedule\Cron;
use Ace\Schedule\iFactory;
use Ace\Schedule\iBuilder;
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
		$builder = $this->createBuilder();
		$director = $this->createDirector($builder);

		// build schedule and inject into Entry
		$matchers = $director->create($schedule);
		return new Entry($matchers);
	}

	protected function createBuilder()
	{	
		return new Builder;
	}

	protected function createDirector(iBuilder $builder)
	{
		return new Director($builder);
	}
}


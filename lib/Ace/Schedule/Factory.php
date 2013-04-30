<?php
namespace Ace\Schedule;
use Ace\Schedule\iFactory;
use Ace\Schedule\iDirector;
use Ace\Schedule\Entry;

/**
* creates an Entry object for a given schedule string
* uses an iDirector which is specific to the schedule string format
*/
class Factory implements iFactory
{
	/**
	* @var iDirector 
	*/
	protected $director;

	public function __construct(iDirector $director)
	{
		$this->director = $director;
	}

	public function createEntry($schedule)
	{
		// build schedule and inject into Entry
		$matchers = $this->director->create($schedule);
		return new Entry($matchers);
	}
}

<?php
namespace Ace\Schedule;
use Ace\Schedule\iFactory;
use Ace\Schedule\iBuilder;
use Ace\Schedule\iDirector;
use Ace\Schedule\Entry;

/**
* creates an Entry object for a given schedule string
* uses an iDirector and iBuilder which are specific to the schedule string format
*/
class Factory implements iFactory
{
	/**
	* @var iDirector 
	*/
	protected $director;

	/**
	* @var iBuilder
	*/
	protected $builder;

	/**
	* @param iDirector $director
	* @param iBuilder $builder
	*/
	public function __construct(iDirector $director, iBuilder $builder)
	{
		$this->director = $director;
		$this->builder = $builder;
	}

	/*
	* @param string $schedule
	*
	* @return Ace\Schedule\Entry
	*/
	public function createEntry($schedule)
	{
		// build schedule and inject into Entry
		$this->director->setBuilder($this->builder);
		$this->director->create($schedule);
		$matchers = $this->builder->getMatchers();
		return new Entry($matchers);
	}
}

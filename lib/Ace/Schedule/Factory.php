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
	* @param string $type
	*
	* @return Ace\Schedule\Entry
	*/
	public function createEntry($schedule, $type)
	{
		// build schedule and inject into Entry
        $parser = $this->getParser($type);
		$this->director->setBuilder($this->builder);
        $this->director->setParser($parser);
		$this->director->create($schedule);
		$matchers = $this->builder->getMatchers();
		return new Entry($matchers);
	}

    /**
    * @throws Ace\Schedule\Exception
    *
    * @param string $type
    * @return iParser
    */
    protected function getParser($type)
    {
        switch ($type){
            case 'cron':
                return new \Ace\Schedule\Cron\Parser;
            case 'calendar':
                return new \Ace\Schedule\Calendar\Parser;
        }

        throw new Exception("Unknown schedule type '$type'");
    }
}

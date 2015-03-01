<?php namespace Ace\Schedule;

use Ace\Schedule\FactoryInterface;
use Ace\Schedule\BuilderInterface;
use Ace\Schedule\DirectorInterface;
use Ace\Schedule\Entry;

/**
* This is the single 'public' class for external clients
*
* Creates an Entry object for a given schedule string and type
*/
class Factory implements FactoryInterface
{
	/**
	* @var DirectorInterface
	*/
	private $director;

	/**
	* @var BuilderInterface
	*/
	private $builder;

	/**
	* @param DirectorInterface $director
	* @param BuilderInterface $builder
	*/
	public function __construct(DirectorInterface $director, BuilderInterface $builder)
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
        return $this->builder->getProduct();
	}

    /**
    * @throws Ace\Schedule\Exception
    *
    * @param string $type
    * @return ParserInterface
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

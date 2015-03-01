<?php namespace Ace\Schedule;

use Ace\Schedule\DirectorInterface;
use Ace\Schedule\BuilderInterface;
use Ace\Schedule\Exception;

/**
* Directs building a set of IMatchers from a formatted schedule string
* Integrates IParser with BuilderInterface to create an Entry
*/
class Director implements DirectorInterface
{
	/**
	* @var BuilderInterface
	*/
	protected $builder;

    /**
    * @var IParser
    */
    protected $parser;

	/**
	* @param BuilderInterface $builder
	*/
	public function setBuilder(BuilderInterface $builder)
	{
		$this->builder = $builder;
	}

    /**
    * @param IParser $parser
    */
    public function setParser(IParser $parser)
    {
        $this->parser = $parser;
    }

	/**
	* @param string $schedule
	*/
	public function create($schedule)
	{
		if (!$this->builder){
			throw new Exception('BuilderInterface instance not set');
		}

        if (!$this->parser) {
			throw new Exception('Parser instance not set');
        }

        $this->parser->parse($schedule);

		// call a builder method for each item
		$this->builder->buildMinute($this->parser->getMinute());
		$this->builder->buildHour($this->parser->getHour());
		$this->builder->buildDay($this->parser->getDay());
		$this->builder->buildMonth($this->parser->getMonth());
        if ($this->parser->getWeekDay()){
		    $this->builder->buildWeekDay($this->parser->getWeekDay());
        }
        // build a year too
	}
}

<?php
namespace Ace\Schedule;
use Ace\Schedule\iDirector;
use Ace\Schedule\iBuilder;
use Ace\Schedule\Exception;

/**
* Directs building a set of iMatchers from a formatted schedule string
*/
class Director implements iDirector
{
	/**
	* @var iBuilder
	*/
	protected $builder;

    /**
    * @var iParser
    */
    protected $parser;

	/**
	* @param iBuilder $builder
	*/
	public function setBuilder(iBuilder $builder)
	{
		$this->builder = $builder;
	}

    /**
    * @param iParser $parser
    */
    public function setParser(iParser $parser)
    {
        $this->parser = $parser;
    }

	/**
	* @param string $schedule
	*/
	public function create($schedule)
	{
		if (!$this->builder instanceof iBuilder){
			throw new Exception('Builder instance not set');
		}

        if (!$this->parser) {
			throw new Exception('Parser instance not set');
        }

        if (!$this->parser->parse($schedule)){
			throw new Exception("Schedule '$schedule' is invalid");
        }

		// call a builder method for each item
		$this->builder->buildMinute($this->parser->getMinute());
		$this->builder->buildHour($this->parser->getHour());
		$this->builder->buildDay($this->parser->getDay());
		$this->builder->buildMonth($this->parser->getMonth());
		$this->builder->buildWeekDay($this->parser->getWeekDay());
        // build a year too
	}
}

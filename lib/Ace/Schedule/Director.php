<?php
namespace Ace\Schedule;
use Ace\Schedule\IDirector;
use Ace\Schedule\IBuilder;
use Ace\Schedule\Exception;

/**
* Directs building a set of IMatchers from a formatted schedule string
*/
class Director implements IDirector
{
	/**
	* @var IBuilder
	*/
	protected $builder;

    /**
    * @var IParser
    */
    protected $parser;

	/**
	* @param IBuilder $builder
	*/
	public function setBuilder(IBuilder $builder)
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
			throw new Exception('Builder instance not set');
		}

        if (!$this->parser) {
			throw new Exception('Parser instance not set');
        }

        $this->parser->parse($schedule);
			//throw new Exception("Schedule '$schedule' is invalid");
       // }

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

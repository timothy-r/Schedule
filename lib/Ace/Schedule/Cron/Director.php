<?php
namespace Ace\Schedule\Cron;
use Ace\Schedule\iDirector;
use Ace\Schedule\iBuilder;
use Ace\Schedule\Exception;

/**
* Directs building a set of iMatchers from a Cron formatted schedule string
* @todo perform all the parsing of the schedule in a separate parser class
* currently it's performed both here and in the Builder class
*/
class Director implements iDirector
{
	/**
	* @var iBuilder
	*/
	protected $builder;
	
	/**
	* @param iBuilder $builder
	*/
	public function setBuilder(iBuilder $builder)
	{
		$this->builder = $builder;
	}

	/**
	* @param string $schedule
	* @return array of iMatcher instances
	*/
	public function create($schedule)
	{
		if (!$this->builder instanceof iBuilder){
			throw new Exception('Builder instance not set');
		}

		$items = preg_split('/[\s]+/', $schedule);
		if (count($items) != 5){
			throw new Exception("Schedule must contain 5 items");
		}

		// call a builder method for each item
		$this->builder->buildMinute($items[0]);
		$this->builder->buildHour($items[1]);
		$this->builder->buildDay($items[2]);
		$this->builder->buildMonth($items[3]);
		$this->builder->buildWeekDay($items[4]);
	}
}

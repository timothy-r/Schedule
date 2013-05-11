<?php
namespace Ace\Schedule\Calendar;
use Ace\Schedule\iDirector;
use Ace\Schedule\iBuilder;
use Ace\Schedule\Exception;

/**
* Directs building a set of iMatchers from a Calendar formatted schedule string
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
	*/
	public function create($schedule)
	{
		if (!$this->builder instanceof iBuilder){
			throw new Exception('Builder instance not set');
		}
        // extract date and time elements from schedule
        $values = date_parse($schedule);
        if ($values['error_count'] > 0){
            throw new Exception("Invalid calendar schedule. ". print_r($values,1));
        }

        $this->builder->buildMinute($this->builder->createLiteral($values['minute']));
        $this->builder->buildHour($this->builder->createLiteral($values['hour']));
        $this->builder->buildDay($this->builder->createLiteral($values['day']));
        $this->builder->buildMonth($this->builder->createLiteral($values['month']));
        // need buildYear
	}
}

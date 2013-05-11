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
	}
}

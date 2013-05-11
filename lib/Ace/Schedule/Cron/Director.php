<?php
namespace Ace\Schedule\Cron;
use Ace\Schedule\iDirector;
use Ace\Schedule\iBuilder;
use Ace\Schedule\Exception;

/**
* Directs building a set of iMatchers from a Cron formatted schedule string
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

		$items = preg_split('/[\s]+/', $schedule);
		if (count($items) != 5){
			throw new Exception("Schedule must contain 5 items");
		}

		// call a builder method for each item
		$this->builder->buildMinute($this->getValue($items[0]));
		$this->builder->buildHour($this->getValue($items[1]));
		$this->builder->buildDay($this->getValue($items[2]));
		$this->builder->buildMonth($this->getValue($items[3]));
		$this->builder->buildWeekDay($this->getValue($items[4]));
	}

	/**
	* @param string $token the raw string from the schedule
	* @return iValue
	*/
	protected function getValue($token) {
		// a wild card *
		if (('*' == $token) || ('?' == $token)){
			return $this->builder->createWildCard();
		}

		// token is a single value - allow for strings for week_day
		if (preg_match('/^(\d+|\w+)$/', $token)){
			return $this->builder->createLiteral($token);
		}

		// a set of tokens 1,2,3
		if (preg_match('/,/', $token)){
			return $this->builder->createAList(explode(',', $token));
		}

		// a range of values 1-3
		if (preg_match('/\-/', $token)){
			$values = explode('-', $token);
			return $this->builder->createRange($values[0], $values[1]);
		}

		// an interval set 1-5/1
		if (preg_match('#/#', $token)){
			$values = explode('/', $value);
			$range = $this->getValue($values[0]);
			return $this->builder->createInterval($range, $values[1]);
		}

		throw new \Ace\Schedule\Exception("'$token' is not a valid cron schedule field value");
	}
}

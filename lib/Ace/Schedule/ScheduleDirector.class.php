<?php
namespace Ace\Schedule;

class ScheduleDirector implements iScheduleDirector
{
	protected $builder;

	public function __construct(iScheduleBuilder $builder)
	{
		$this->builder = $builder;
	}
	
	/**
	* @param string $schedule
	* @return array of iMatcher instances
	*/
	public function create($schedule)
	{
		$matchers = array();
		$items = preg_split('/[\s]+/', $schedule);
		if (count($items) != 5){
			throw new Exception("Schedule must contain 5 items");
		}

		// call a builder method for each item
		$matchers['min']= $this->builder->buildMinute($items[0]);
		$matchers['hour']= $this->builder->buildHour($items[1]);
		$matchers['day']= $this->builder->buildDay($items[2]);
		$matchers['month']= $this->builder->buildMonth($items[3]);
		$matchers['week_day']= $this->builder->buildWeekDay($items[4]);

		return $matchers;
	}
}

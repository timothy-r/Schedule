<?php namespace Ace\Schedule;

/**
* creates an Entry instance
*/
interface FactoryInterface
{
    /**
    * @param string $schedule
    * @param string $type
    * @return Ace\Schedule\Entry
    */
	public function createEntry($schedule, $type);
}

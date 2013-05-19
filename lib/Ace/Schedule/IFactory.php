<?php
namespace Ace\Schedule;
/**
* creates an Entry instance
*/
interface IFactory
{
    /**
    * @param string $schedule
    * @param string $type
    * @return Ace\Schedule\Entry
    */
	public function createEntry($schedule, $type);
}

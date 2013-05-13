<?php
namespace Ace\Schedule;

/**
* creates an Entry instance
*/
interface iFactory
{
    /**
    * @todo add a second param to indicate schedule type, eg cron or date
    */
	public function createEntry($schedule);
}

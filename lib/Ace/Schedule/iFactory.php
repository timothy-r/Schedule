<?php
namespace Ace\Schedule;

/**
* creates an Entry instance
*/
interface iFactory
{
	public function createEntry($schedule);
}

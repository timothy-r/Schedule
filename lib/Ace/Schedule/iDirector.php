<?php
namespace Ace\Schedule;
/**
* interface to create a schedule of iMatcher instances using an iBuilder
*/
interface iDirector
{
	/**
	* @param string $schedule
	*/
	public function create($schedule);
	
	/**
	* @param iBuilder $builder
	*/
	public function setBuilder(iBuilder $builder);
}

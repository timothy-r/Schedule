<?php
namespace Ace\Schedule;
/**
* interface to create a schedule of iMatcher instances using an IBuilder
*/
interface iDirector
{
	/**
	* @param string $schedule
	*/
	public function create($schedule);
	
	/**
	* @param IBuilder $builder
	*/
	public function setBuilder(IBuilder $builder);
    
    /**
    * @param iParser $parser
    */
    public function setParser(iParser $parser);
}

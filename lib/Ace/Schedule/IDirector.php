<?php
namespace Ace\Schedule;
/**
* interface to create a schedule of IMatcher instances using an IBuilder
*/
interface IDirector
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
    * @param IParser $parser
    */
    public function setParser(IParser $parser);
}

<?php namespace Ace\Schedule;

/**
* interface to create a schedule of IMatcher instances using an BuilderInterface
*/
interface DirectorInterface
{
	/**
	* @param string $schedule
	*/
	public function create($schedule);
	
	/**
	* @param BuilderInterface $builder
	*/
	public function setBuilder(BuilderInterface $builder);
    
    /**
    * @param IParser $parser
    */
    public function setParser(IParser $parser);
}

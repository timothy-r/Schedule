<?php namespace Ace\Schedule;

/**
* interface to create a schedule of MatcherInterface instances using an BuilderInterface
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
    * @param ParserInterface $parser
    */
    public function setParser(ParserInterface $parser);
}
